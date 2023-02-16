<?php

namespace Database\Seeders;

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

            PropertiesTableSeeder::class,
            TenantsTableSeeder::class,
        ]);
    }
}