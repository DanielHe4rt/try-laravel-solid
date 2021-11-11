<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
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

// View Routes

Route::get('/', [ViewController::class, 'viewLanding'])->name('landing');
Route::get('/dashboard', [ViewController::class, 'viewDashboard'])->name('dashboard');


// Action Routes

Route::get('/auth/oauth/twitch', [AuthController::class, 'getTwitchProvider']);
Route::get('/auth/oauth/github', [AuthController::class, 'getGithubProvider']);
Route::get('/auth/logout', [AuthController::class, 'getLogout'])->name('logout');
