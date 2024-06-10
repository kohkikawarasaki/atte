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
        User::factory(8)->create()->each(function ($user) {
            Work::factory(8)->for($user)->create()->each(function ($work) use ($user) {
                Breaking::factory(rand(1, 3))->for($work)->for($user)->create();
            });
        });
    }
}
