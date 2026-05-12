<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;

class RoleService
{
    public function create($roleName, $permissions = [])
    {
        $role = Role::create([
            'name' => $roleName
        ]);
        $permissionIds = [];
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => trim($permissionName),
            ], [
                'name' => trim($permissionName),
            ]);
            $permissionIds[] = $permission->id;
        }

        //Add bảng trung gian
        $role->permissions()->attach($permissionIds);
    }
}
