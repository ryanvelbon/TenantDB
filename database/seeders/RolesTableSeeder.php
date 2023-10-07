<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // ++++ Admin ++++

        $role = Role::create(['id' => 1, 'title' => 'Admin']);
        $permissions = Permission::all();
        $role->permissions()->sync($permissions->pluck('id'));


        // ++++ User ++++

        $role = Role::create(['id' => 2, 'title' => 'User']);
        $permissions = Permission::all()->reject(function ($permission) {return preg_match('/^(user|role|permission|team)_/', $permission->title); });
        $role->permissions()->sync($permissions);


        // ++++ Landlord ++++

        Role::create(['id' => 3, 'title' => 'Landlord'])
            ->attachPermissions([
                'property_create',
                'property_edit',
                'property_show',
                'property_delete',
                'property_access',
                'tenant_create',
                'tenant_edit',
                'tenant_show',
                'tenant_delete',
                'tenant_access',
                'tenant_report_create',
                'tenant_report_edit',
                'tenant_report_show',
                'tenant_report_delete',
                'tenant_report_access',
        ]);


        // ++++ Agent ++++

        Role::create(['id' => 4, 'title' => 'Agent'])
            ->attachPermissions([]);


        // ++++ Tenant ++++

        Role::create(['id' => 5, 'title' => 'Tenant'])
            ->attachPermissions([]);
    }
}