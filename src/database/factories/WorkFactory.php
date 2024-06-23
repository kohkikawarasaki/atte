<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('09:00:00', '12:00:00')->format('H:i:s');
        $endTime = Carbon::parse($startTime)->addHours(rand(4, 8))->format('H:i:s');

        return [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
