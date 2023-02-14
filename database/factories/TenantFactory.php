<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'nationality' => Country::inRandomOrder()->first(),
            'passport' => rand(10000000, 999999999999),
            'id_card' => rand(10000000, 999999999999),
            'dob' => date('Y-m-d', rand(strtotime("-80 year"), strtotime("-18 year"))),
            'created_by' => User::inRandomOrder()->first(),
        ];
    }
}
