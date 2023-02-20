<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id'             => 1,
            'name'           => 'Curtis',
            'email'          => 'curtis@x.com',
            'password'       => bcrypt('password'),
            'remember_token' => null,
        ])->assignRole('admin');

        User::create([
            'id'             => 2,
            'name'           => 'Cheryl',
            'email'          => 'cheryl@x.com',
            'password'       => bcrypt('password'),
            'remember_token' => null,
        ])->assignRole('admin');
    }
}