<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\MessagesController;
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
Route::get('/profile', [ViewController::class, 'viewProfile'])->name('profile');


// Auth Routes

Route::get('/auth/oauth/{provider}', [AuthController::class, 'auth']);
Route::get('/auth/logout', [AuthController::class, 'getLogout'])->name('logout');

// User Routes

Route::post('/me/update-avatar', [MeController::class, 'postProfileAvatar'])->name('update-avatar');
Route::delete('/me', [MeController::class, 'deleteMe'])->name('delete-account');

// Messages Routes

Route::post('/messages', [MessagesController::class, 'postMessage'])->name('new-message');
