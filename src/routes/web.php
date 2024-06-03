<?php

use App\Http\Controllers\StampController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [StampController::class, 'index']);
    Route::post('/work_start', [StampController::class, 'workStart']);
    Route::post('/work_end', [StampController::class, 'workEnd']);
    Route::post('/break_start', [StampController::class, 'breakStart']);
    Route::post('/break_end', [StampController::class, 'breakEnd']);
    Route::get('/attendance', [StampController::class, 'attendance']);
});

