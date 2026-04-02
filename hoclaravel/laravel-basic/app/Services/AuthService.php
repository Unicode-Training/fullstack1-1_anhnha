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
        $payload = [
            'id' => $user->id,
            'exp' => time() + env('JWT_EXPIRED')
        ];
        $accessToken = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return compact('accessToken');
    }

    public function profile($token)
    {
        //Verify token xem có hợp lệ không?
        try {
            $decoded =  JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            //Check blacklist
            $blacklist = Redis::get("blacklist:$token");
            if ($blacklist) {
                throw new Exception("Blacklist");
            }
            $userId = $decoded->id;
            $user = User::find($userId);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    public function logout($token)
    {
        $key = "blacklist:$token";
        $payload = explode('.', $token)[1];
        $decodedJson = base64_decode($payload);
        $decoded = json_decode($decodedJson);
        $exp = $decoded->exp;
        $seconds = $exp - time();
        Redis::setEx($key, $seconds, 1);
    }
}
