<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'property_create',
            ],
            [
                'id'    => 18,
                'title' => 'property_edit',
            ],
            [
                'id'    => 19,
                'title' => 'property_show',
            ],
            [
                'id'    => 20,
                'title' => 'property_delete',
            ],
            [
                'id'    => 21,
                'title' => 'property_access',
            ],
            [
                'id'    => 22,
                'title' => 'tenant_create',
            ],
            [
                'id'    => 23,
                'title' => 'tenant_edit',
            ],
            [
                'id'    => 24,
                'title' => 'tenant_show',
            ],
            [
                'id'    => 25,
                'title' => 'tenant_delete',
            ],
            [
                'id'    => 26,
                'title' => 'tenant_access',
            ],
            [
                'id'    => 27,
                'title' => 'tenant_report_create',
            ],
            [
                'id'    => 28,
                'title' => 'tenant_report_edit',
            ],
            [
                'id'    => 29,
                'title' => 'tenant_report_show',
            ],
            [
                'id'    => 30,
                'title' => 'tenant_report_delete',
            ],
            [
                'id'    => 31,
                'title' => 'tenant_report_access',
            ],
            [
                'id'    => 32,
                'title' => 'contract_create',
            ],
            [
                'id'    => 33,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 34,
                'title' => 'contract_show',
            ],
            [
                'id'    => 35,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 36,
                'title' => 'contract_access',
            ],
            [
                'id'    => 99,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}