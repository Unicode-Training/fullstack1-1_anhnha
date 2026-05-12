<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Lấy thông tin user
        //Check role của user
        //Kiểm tra các role được phép
        $user = $request->user;
        if ($user->role === 'CUSTOMER') {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden'
            ], 403);
        }
        return $next($request);
    }
}
