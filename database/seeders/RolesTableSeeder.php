<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $role = Role::create(['id' => 1, 'title' => 'Admin']);
        $permissions = Permission::all();
        $role->permissions()->sync($permissions->pluck('id'));


        $role = Role::create(['id' => 2, 'title' => 'User']);
        $permissions = Permission::all()->reject(function ($permission) {return preg_match('/^(user|role|permission|team)_/', $permission->title); });
        $role->permissions()->sync($permissions);
    }
}