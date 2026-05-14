<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }
 }
