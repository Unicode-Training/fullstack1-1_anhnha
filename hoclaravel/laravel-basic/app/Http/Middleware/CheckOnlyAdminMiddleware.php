<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOnlyAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user;
        if ($user->role === 'ADMIN') {
             return $next($request);
        }
        return response()->json([
            'success' => false,
            'message' => 'Forbidden'
        ], 403);
    }
}
