<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;

Route::middleware(['auth:customer'])->group(function () {

    // Route hiển thị trang hồ sơ (GET)
    Route::get('/profile', [ProfileController::class, 'index'])->name('customer.profile.index');
    Route::get('/profile/update', [ProfileController::class, 'editProfile'])->name('customer.profile.edit');

    // Route xử lý cập nhật thông tin (PUT hoặc POST)
    // Lưu ý: Ở phần view trước ta dùng @method('PUT') nên ở đây dùng Route::put
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('customer.profile.update');

});
Route::get('/', function () {
    return view('customer.landing');
})->name('landing');

//Customer Routes
Route::get('/register', [CustomerController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomerController::class, 'register'])->name('register.post');
Route::get('/login', [CustomerController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomerController::class, 'login'])->name('login.post');
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
Route::get('/about', [CustomerController::class, 'showAbout'])->name('about');
Route::get('/contact', [CustomerController::class, 'showContact'])->name('contact');
Route::get('/services', [CustomerController::class, 'showServices'])->name('services');
Route::get('/services/terms', [CustomerController::class, 'showServiceTerms'])->name('terms');
Route::get('/services/policy', [CustomerController::class, 'showServicePolicy'])->name('policy');
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/booking', [CustomerController::class, 'showBooking'])->name('booking');
    Route::post('/booking', [CustomerController::class, 'storeBooking'])->name('booking.post');
    Route::get('/my-orders', [CustomerController::class, 'showOrders'])->name('customer.orders.index');
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
        Route::get('/customers/{id}/overview', [AdminController::class, 'customerOverview'])->name('customers.overview');
        Route::get('/customers/{id}/security', [AdminController::class, 'customerSecurity'])->name('customers.security');
        Route::get('/customers/{id}/billing', [AdminController::class, 'customerBilling'])->name('customers.billing');
        Route::get('/customers/{id}/notifications', [AdminController::class, 'customerNotifications'])->name('customers.notifications');

        Route::get('/fleet', [AdminController::class, 'fleet'])->name('fleet.index');
        Route::get('/users/{id}/account', [AdminController::class, 'userAccount'])->name('users.account');

        Route::get('/employees', [AdminController::class, 'employeesIndex'])->name('employees.index');
        Route::post('/employees', [AdminController::class, 'employeeStore'])->name('employees.store');
        Route::get('/employees/{id}', [AdminController::class, 'employeeShow'])->name('employees.show');
        Route::put('/employees/{id}', [AdminController::class, 'employeeUpdate'])->name('employees.update');
        Route::delete('/employees/{id}', [AdminController::class, 'employeeDestroy'])->name('employees.destroy');

    });
});
Route::get('/admin', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

////Agent Routes
//use App\Http\Controllers\AgentController;
//Route::prefix('agent')->name('agent.')->middleware('auth:agent')->group(function () {
//    Route::get('/orders', [AgentController::class, 'index'])->name('orders.index');
//    Route::get('/orders/{id}', [AgentController::class, 'show'])->name('orders.show');
//    Route::post('/orders/{id}/accept', [AgentController::class, 'accept'])->name('orders.accept');
//    Route::post('/orders/{id}/complete', [AgentController::class, 'complete'])->name('orders.complete');
//});
// Agent Auth Routes (public)
Route::prefix('agent')->name('agent.')->group(function () {
    Route::get('/login',    [AgentController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AgentController::class, 'login'])->name('login.post');
    Route::get('/register', [AgentController::class, 'showRegister'])->name('register');
    Route::post('/register',[AgentController::class, 'register'])->name('register.post');
    Route::post('/logout',  [AgentController::class, 'logout'])->name('logout');
});

// Agent Protected Routes
Route::prefix('agent')->name('agent.')->middleware('auth:agent')->group(function () {
    // Orders
    Route::get('/orders',                    [AgentController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}',               [AgentController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/accept',       [AgentController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{id}/complete',     [AgentController::class, 'complete'])->name('orders.complete');

    // Couriers (tra cứu theo ID)
    Route::get('/couriers',                  [AgentController::class, 'couriersIndex'])->name('couriers.index');

    // Customers
    Route::get('/customers',                 [AgentController::class, 'customersIndex'])->name('customers.index');
    Route::get('/customers/{id}',            [AgentController::class, 'customersShow'])->name('customers.show');
});
