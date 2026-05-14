<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\DB;

class RoleService
{

    public function findAll() {
        // DB::enableQueryLog();
        // $roles = Role::all();
        // foreach ($roles as $role) {
        //     $role->permissions = $role->per;
        // }
        //  return DB::getQueryLog();

        // DB::enableQueryLog();
        $roles = Role::with('permissions')->get();
        foreach($roles as $role) {
            $values = [];
            foreach ($role->permissions as $item) {
                $values[] = $item->name;
            }
            unset($role->permissions);
            $role->permissions = $values;
        }
        // return DB::getQueryLog();
        return $roles;
    }

    public function find($id) {
        $role = Role::with('permissions')->find($id);
        if (!$role) {
           throw new NotFoundException("Không tìm thấy");
        }
        $values = [];
        foreach ($role->permissions as $item) {
            $values[] = $item->name;
        }
        unset($role->permissions);
        $role->permissions = $values;
        return $role;
    }

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

    public function update($roleName, $permissions = [], $id) {
        $role = Role::find($id);
        if ($roleName) {
             $role->update(['name' => $roleName]);
        }
    
        $permissionIds = [];
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => trim($permissionName),
            ], [
                'name' => trim($permissionName),
            ]);
            $permissionIds[] = $permission->id;
        }

         $role->permissions()->sync($permissionIds);
    }

    public function delete($id) {
        //Xóa dữ liệu bảng trung gian
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->permissions()->sync([]);
            $role->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
       
    }

    public function addUser($roleId, $users = []) {
        $role = Role::find($roleId);
        $role->users()->attach($users);
    }

    public function deleteUser($roleId, $users = []) {
        $role = Role::find($roleId);
        $role->users()->detach($users);
    }
}

//Query n + 1
//Exception
// - NotFound --> 404
// - Forbidden --> 403
// - Unathorize --> 401
// - Internal Server Error --> 500
// - Too Many Requests --> 429
// - Bad Request --> 400
// - Unprocessable Content --> 422