<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $token = $this->authService->login($request->all());
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => "Email hoặc mật khẩu không đúng"
            ], 401);
        }
        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => $token
        ]);
    }

    public function register(Request $request)
    {
        //Validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        $user = $this->authService->register($request->all());

        return response()->json([
            'message' => 'Register success',
            'success' => true,
            'data' => $user
        ]);
    }

    public function profile(Request $request)
    {
        return $request->user;
    }

    public function logout(Request $request)
    {
        $token = $request->token;
        return $this->authService->logout($token);
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = $request->refreshToken;
        $newToken = $this->authService->refreshToken($refreshToken);
        if (!$newToken) {
            return response()->json([
                'success' => false,
                'message' => "Refresh token failed"
            ], 401);
        }
        return response()->json([
            'success' => true,
            'message' => 'Refresh token success',
            'data' => $newToken
        ]);
    }

    public function revokeToken($userId)
    {
        return $this->authService->revokeToken($userId);
    }
}
