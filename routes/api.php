<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('teams', TeamController::class)->except(['edit', 'create']);
    Route::resource('players', PlayerController::class)->except(['edit', 'create']);
    Route::resource('games', GameController::class)->except(['edit', 'create']);
    Route::post('/games/{game}/update-score', [ScoreController::class, 'update'])->name('score.update');
    Route::get('/games/{game}/report', [ReportController::class, 'index'])->name('games.report');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request){
        return $request->user();
    });
});

