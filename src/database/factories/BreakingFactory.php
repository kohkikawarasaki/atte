<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Work;
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
        $startTime = $this->faker->time('H:i:s');
        $endTime = Carbon::parse($startTime)->addMinutes(rand(15, 120))->format('H:i:s');

        return [
            'work_id' => Work::factory(),
            'user_id' => User::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
