<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService) {}
    public function index() {
        return response()->json([
            'success' => true,
            'data' => $this->roleService->findAll()
        ]);
    }
    public function create(Request $request)
    {
        return $this->roleService->create($request->name, $request->permissions);
    }
    public function find($id) {
        $role = $this->roleService->find($id);
        return response()->json([
            'success' => true,
            'data' => $role
        ]);
    }
    public function update(Request $request, $id) {
        return $this->roleService->update($request->name, $request->permissions, $id);
    }

    public function delete($id) {
        return $this->roleService->delete($id);
    }

    public function addUsers(Request $request, $id) {
        $users = $request->all();
        return $this->roleService->addUser($id, $users);
    }

    public function deleteUsers(Request $request, $id) {
        $users = $request->all();
        return $this->roleService->deleteUser($id, $users);
    }
}

//endpoint: GET /api/admin/roles