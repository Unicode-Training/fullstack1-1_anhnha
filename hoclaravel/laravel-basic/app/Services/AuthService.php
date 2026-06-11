<?php

namespace App\Services;

use App\Models\User;
use Error;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class AuthService
{
    public function register($userData)
    {
        return User::create([
            ...$userData,
            'password' => Hash::make($userData['password'])
        ]);
    }

    public function login($loginData)
    {
        $status = Auth::attempt($loginData);
        if (!$status) {
            //throw exception
            return false;
        }
        $user = User::where('email', $loginData['email'])->first();

        //Tạo token
        $accessToken = $this->createAccessToken($user);
        $refreshToken = $this->createRefreshToken($user);

        //Lưu jti của refreshToken
        //key: refreshToken:{userId}:{jti}
        $accessTokenDecoded = $this->decodeToken($accessToken);
        $refreshTokenDecoded = $this->decodeToken($refreshToken);
        $key = "refreshToken:{$user->id}:{$refreshTokenDecoded->jti}";
        $value = [
            'accessTokenJti' => $accessTokenDecoded->jti,
            'refreshTokenJti' => $refreshTokenDecoded->jti,
        ];
        $ttlRefreshToken = $refreshTokenDecoded->exp - time();
        Redis::setEx($key, $ttlRefreshToken, json_encode($value)); //set ttl bằng thời gian sống của refresh token

        return compact('accessToken', 'refreshToken');
    }

    public function refreshToken($refreshToken)
    {
        //verify token
        try {
            $decoded =  JWT::decode($refreshToken, new Key(env('JWT_REFRESH_SECRET'), 'HS256'));
            //Check redis
            $key = "refreshToken:{$decoded->id}:{$decoded->jti}";
            $tokenFromRedis = Redis::get($key);
            if (!$tokenFromRedis) {
                throw new Exception("Refresh token invalid");
            }
            //Tạo token mới
            $accessToken = $this->createAccessToken($decoded);
            $refreshToken = $this->createRefreshToken($decoded);
            //Thu hồi refresh cũ
            Redis::del($key);

            //Thêm token mới vào redis
            $accessTokenDecoded = $this->decodeToken($accessToken);
            $refreshTokenDecoded = $this->decodeToken($refreshToken);
            $key = "refreshToken:{$decoded->id}:{$refreshTokenDecoded->jti}";
            $value = [
                'accessTokenJti' => $accessTokenDecoded->jti,
                'refreshTokenJti' => $refreshTokenDecoded->jti,
            ];
            $ttlRefreshToken = $refreshTokenDecoded->exp - time();

            Redis::setEx($key, $ttlRefreshToken, json_encode($value));

            return compact('accessToken', 'refreshToken');

            //JWT Refresh token rotation
        } catch (Exception $exception) {
            return false;
        }
    }

    private function createAccessToken($user)
    {
        $payload = [
            'id' => $user->id,
            'exp' => time() + env('JWT_EXPIRED'),
            'jti' => uniqid("", false) . time()
        ];
        $accessToken = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        return $accessToken;
    }

    private function createRefreshToken($user)
    {
        $jti = uniqid("", false) . time();
        $payload = [
            'id' => $user->id,
            'exp' => time() + env('JWT_REFRESH_EXPIRED'),
            'jti' => $jti
        ];
        $refreshToken = JWT::encode($payload, env('JWT_REFRESH_SECRET'), 'HS256');

        return $refreshToken;
    }

    private function decodeToken($token)
    {
        $payload = explode('.', $token)[1];
        $decodedJson = base64_decode($payload);
        $decoded = json_decode($decodedJson);
        return $decoded;
    }

    public function profile($token)
    {
        //Verify token xem có hợp lệ không?
        try {
            $decoded =  JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            //Check blacklist
            $blacklist = Redis::get("blacklist:{$decoded->jti}");
            if ($blacklist) {
                throw new Exception("Blacklist");
            }
            $userId = $decoded->id;
            $user = User::find($userId);
            $permissions = $user->roles()->with('permissions')->get();
            $permissonValues = [];
            foreach ($permissions as $item) {
                foreach ($item->permissions as $permission) {
                    if (!in_array($permission->name, $permissonValues)) {
                        $permissonValues[] = $permission->name;
                    }
                }
            }
            $user->permissions = $permissonValues;
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    public function logout($token)
    {
        $payload = explode('.', $token)[1];
        $decodedJson = base64_decode($payload);
        $decoded = json_decode($decodedJson);
        $exp = $decoded->exp;
        $jti = $decoded->jti;
        $seconds = $exp - time();
        $key = "blacklist:$jti";
        Redis::setEx($key, $seconds, 1);
    }

    public function revokeToken($userId)
    {
        $keys = Redis::keys("refreshToken:$userId:*");
        $prefix = config('database.redis.options.prefix');

        foreach ($keys as $key) {
            $keyWithoutPrefix = str_replace($prefix, '', $key);
            $valueJson = Redis::get($keyWithoutPrefix);
            $value = json_decode($valueJson);
            $accessTokenJti = $value->accessTokenJti;
            Redis::set("blacklist:$accessTokenJti", 1);
            Redis::del($keyWithoutPrefix);
        }
    }
}
