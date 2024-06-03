<?php

namespace App\Console\Commands;

use App\Models\Breaking;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EndWork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '日を跨ぐ時点で業務及び休憩を終了する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $yesterday = Carbon::yesterday()->toDateString();
        foreach ($users as $user) {
            $work = Work::where('user_id', $user->id)->where('work_date', $yesterday)->first();
            if ($work && !$work->end_time) {
                $break = Breaking::where('work_id', $work->id)->latest('id')->first();
                if ($break && !$break->end_time) {
                    $break->update([
                        'end_time' => '23:59:59',
                    ]);
                }
                $work->update([
                    'end_time' => '23:59:59',
                ]);
            }
        }
    }
}
