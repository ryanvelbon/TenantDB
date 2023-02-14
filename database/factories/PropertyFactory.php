<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;


class PropertyFactory extends Factory
{
    public function definition()
    {
        $types = \App\Models\Property::TYPE_SELECT;

        return [
            'address' => str_replace("\n",", ",fake()->address()),
            'type' => $types[array_rand($types)]['value'],
            'size' => rand(50,200),
            'n_bedrooms' => rand(1,4),
            'n_bathrooms' => rand(1,3),
            'created_by' => User::inRandomOrder()->first()
        ];
    }
}