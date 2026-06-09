<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissionName): Response
    {
        $user = $request->user;
        //skip admin
        if ($user->role === 'ADMIN') {
             return $next($request);
        }
        $permissions = $user->roles()->with('permissions')->get();
        $permissonValues = [];
        foreach ($permissions as $item) {
            foreach ($item->permissions as $permission) {
                if (!in_array($permission->name, $permissonValues)) {
                    $permissonValues[] = $permission->name;
                }
            }
        }

        if (!in_array($permissionName, $permissonValues)) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden',
                
            ], 403);
        } 

         return $next($request);
       
    }
}
