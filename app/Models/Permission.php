<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";
    protected $guarded = [];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id','role_id');
    }

    public function hasRolePermission($roleId)
    {
        if ($this->role()->where('role_id', $roleId)->first()) {
            return true;
        }
        return false;
    }
}
