<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService) {}
    public function create(Request $request)
    {
        return $this->roleService->create($request->name, $request->permissions);
    }
}
