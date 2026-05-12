<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    private $authService = null;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Lấy được token từ header

        //Truy vấn tới database để lấy thông tin user
        $authHeader = $request->header('authorization');
        $tokenArr = array_filter(explode(' ', $authHeader));
        if (!empty($tokenArr)) {
            $token = $tokenArr[1];
            $user = $this->authService->profile($token);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unathorize'
                ], 401);
            }
            $request->user = $user;
            $request->token = $token;
            return $next($request);
        }
        return response()->json([
            'success' => false,
            'message' => 'Unathorize'
        ], 401);
    }
}
