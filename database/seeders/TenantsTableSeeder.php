<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant;

class TenantsTableSeeder extends Seeder
{
    public function run()
    {
        Tenant::factory(1000)->create();
    }
}
