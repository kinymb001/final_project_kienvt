<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
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
    Route::get('/admin')->name('admin.dashboard');
});

// Agent Routes
Route::middleware(['auth', 'role:Agent'])->group(function () {
    Route::get('/agent')->name('agent.dashboard');
});

// Regular User Routes
Route::middleware(['auth', 'role:Regular User'])->group(function () {
    Route::get('/user')->name('user.dashboard');
});
Route::middleware(['auth'])->group(function () {
    // Route cho danh sách tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    // Route cho tạo ticket
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

    // Route cho chỉnh sửa và xóa ticket (admin và agent)
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // Route cập nhật trạng thái ticket (admin)
    Route::post('/tickets/{ticket}/status', [TicketController::class, 'changeStatus'])->name('tickets.status.update');
});
