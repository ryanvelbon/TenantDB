<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

class ContractFactory extends Factory
{
    public function definition()
    {
        $startDate = date('Y-m-d', rand(strtotime("-5 year"), strtotime("+6 month")));

        $nMonths = rand(1,4)*6;

        $endDate = new DateTime($startDate);
        $endDate->modify("+ $nMonths months");
        $endDate = $endDate->format('Y-m-d');

        $rent = rand(4,50)*100;

        return [
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'rent'       => $rent,
            'deposit'    => $rent * rand(1,3),
        ];
    }
}
