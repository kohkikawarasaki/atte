<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreakingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startTime = $this-> faker->dateTimeBetween('12:00:00', '13:00:00')->format('H:i:s');
        $endTime = Carbon::parse($startTime)->addMinutes(rand(15, 120))->format('H:i:s');

        return [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
