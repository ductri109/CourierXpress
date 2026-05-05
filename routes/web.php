<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.landing');
})->name('landing');

//Customer Routes
Route::get('/register', [CustomerController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomerController::class, 'register'])->name('register.post');
Route::get('/login', [CustomerController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomerController::class, 'login'])->name('login.post');
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/booking', [CustomerController::class, 'showBooking'])->name('booking');
    Route::post('/booking', [CustomerController::class, 'storeBooking'])->name('booking.post');
});

//Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware(['auth:admin'])->group(function () {   
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');   
        Route::get('/orders', [AdminController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/assign', [AdminController::class, 'assignAgent'])->name('orders.assign');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
Route::get('/admin', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

//Agent Routes
use App\Http\Controllers\AgentController;
Route::prefix('agent')->name('agent.')->middleware('auth:agent')->group(function () {
    Route::get('/orders', [AgentController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AgentController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/accept', [AgentController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{id}/complete', [AgentController::class, 'complete'])->name('orders.complete');
});