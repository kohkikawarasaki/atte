<?php

namespace App\Http\Controllers;

use App\Models\Breaking;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class StampController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $today = Carbon::today()->toDateString();
        $work = Work::where('user_id', $userId)->where('work_date', $today)->first();
        $canStartWork = false;
        $canEndWork = false;
        $canStartBreak = false;
        $canEndBreak = false;

        if ($work) {
            $break = Breaking::where('work_id', $work->id)->latest('id')->first();
            $canEndWork = !$work->end_time && (!$break || $break->end_time);
            $canStartBreak = !$work->end_time && (!$break || $break->end_time);
            if ($break) {
                $canEndBreak = !$work->end_time && !$break->end_time;
            }
        } else {
            $canStartWork = true;
        }

        return view('stamp', compact('userName', 'canStartWork', 'canEndWork', 'canStartBreak', 'canEndBreak'));
    }

    public function workStart()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();
        Work::create([
            'user_id' => $userId,
            'work_date' => $today,
            'start_time' => $now,
        ]);

        return redirect('/');
    }

    public function workEnd()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();
        $work = Work::where('user_id', $userId)->where('work_date', $today)->first();
        if ($work) {
            $work->update([
                'end_time' => $now,
            ]);
        }

        return redirect('/');
    }

    public function breakStart()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();
        $work = Work::where('user_id', $userId)->where('work_date', $today)->first();
        if ($work) {
            Breaking::create([
                'work_id' => $work->id,
                'user_id' => $userId,
                'start_time' => $now,
            ]);
        }

        return redirect('/');
    }

    public function breakEnd()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();
        $work = Work::where('user_id', $userId)->where('work_date', $today)->first();
        if ($work) {
            $break = Breaking::where('work_id', $work->id)->latest('id')->first();
            if ($break) {
                $break->update([
                    'end_time' => $now,
                ]);
            }
        }

        return redirect('/');
    }

    public function attendance(Request $request)
    {
        $users = User::all();
        $date = $request->input('date', Carbon::today()->toDateString());
        $StampData = [];

        foreach ($users as $user) {
            $totalBreakTime = 0;
            $totalWorkTime = 0;
            $work = Work::where('user_id', $user->id)->where('work_date', $date)->first();
            if ($work) {
                if ($work->end_time) {
                    $breaks = Breaking::where('work_id', $work->id)->where('user_id', $user->id)->get();
                    foreach ($breaks as $break) {
                        if ($break->start_time && $break->end_time) {
                            $totalBreakTime += Carbon::parse($break->end_time)->diffInSeconds(Carbon::parse($break->start_time));
                        }
                    }
                    $hours = floor($totalBreakTime / 3600);
                    $minutes = floor(($totalBreakTime % 3600) / 60);
                    $seconds = $totalBreakTime % 60;
                    $formattedTotalBreakTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                    $totalWorkTime = Carbon::parse($work->end_time)->diffInSeconds(Carbon::parse($work->start_time)) - $totalBreakTime;
                    $hours = floor($totalWorkTime / 3600);
                    $minutes = floor(($totalWorkTime % 3600) / 60);
                    $seconds = $totalWorkTime % 60;
                    $formattedTotalWorkTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                } else {
                    $formattedTotalBreakTime = '-';
                    $formattedTotalWorkTime = '-';
                }
                $StampData[] = [
                    'user' => $user,
                    'work' => $work,
                    'totalBreakTime' => $formattedTotalBreakTime,
                    'totalWorkTime' => $formattedTotalWorkTime,
                ];
            }
        }

        $StampData = collect($StampData);

        $StampData = new LengthAwarePaginator(
            $StampData->forPage($request->page, 5),
            count($StampData),
            5,
            $request->page,
            array('path' => $request->url())
        );

        $StampData->appends(['date' => $date]);

        $date = Carbon::parse($date);

        return view('attendance', compact('StampData', 'date'));
    }
}
