<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'id'             => 1,
                'name'           => 'Curtis',
                'email'          => 'curtis@x.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Cheryl',
                'email'          => 'cheryl@x.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($admins);

        foreach ($admins as $admin) {
            User::findOrFail($admin['id'])->roles()->sync(Role::where('title', 'Admin')->first());
        }

        // generates some dummy end-users
        User::factory(20)
            ->hasAttached(Role::where('title', 'User')->first())
            ->create();
    }
}