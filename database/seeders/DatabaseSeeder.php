<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([

            CountriesTableSeeder::class,

            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        $landlords = User::factory(10)
            ->hasAttached(Role::find(3))
            ->hasProperties(2)
            ->hasTenants(10)
            ->create();
    }
}