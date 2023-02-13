<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Property;
use App\Models\User;

class PropertiesTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i=0; $i < rand(0,10); $i++) { 
                Property::factory()->create(['created_by' => $user->id]);
            }
        }
    }
}