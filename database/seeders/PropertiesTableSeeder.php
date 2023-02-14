<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Property;

class PropertiesTableSeeder extends Seeder
{
    public function run()
    {
        Property::factory(100)->create();
    }
}