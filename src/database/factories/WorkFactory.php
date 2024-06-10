<?php

namespace Database\Factories;

use App\Models\User;
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
        $startTime = $this->faker->time('H:i:s');
        $endTime = Carbon::parse($startTime)->addHours(rand(3, 8))->format('H:i:s');
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDay(3);


        return [
            'user_id' => User::factory(),
            'work_date' => $this->faker->dateTimeBetween($startDate, $endDate),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
