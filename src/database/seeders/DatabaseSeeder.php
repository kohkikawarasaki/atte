<?php

namespace Database\Seeders;

use App\Models\Breaking;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com'
        ]);
        User::factory(10)->create()->each(function ($user) {
            $today = Carbon::today();
            for ($i = 0; $i < 7; $i++) {
                $workDate = $today->copy()->subDays($i);

                $work = Work::factory()->create([
                    'user_id' => $user->id,
                    'work_date' => $workDate
                ]);

                Breaking::factory(rand(0, 2))->create([
                    'work_id' => $work->id,
                    'user_id' => $user->id
                ]);
            }
        });
    }
}
