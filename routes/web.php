<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Common route for all authenticated users
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Administrator Routes
Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Agent Routes
Route::middleware(['auth', 'role:Agent'])->group(function () {
    Route::get('/agent', [HomeController::class, 'agentDashboard'])->name('agent.dashboard');
});

// Regular User Routes
Route::middleware(['auth', 'role:Regular User'])->group(function () {
    Route::get('/user', [HomeController::class, 'userDashboard'])->name('user.dashboard');
});
