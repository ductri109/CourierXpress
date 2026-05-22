<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

// ============================================================
// CUSTOMER ROUTES
// ============================================================
Route::get('/', fn() => view('customer.landing'))->name('landing');
Route::post('/update-fcm-token', [CustomerController::class, 'updateFcmToken'])->name('customer.updateFcmToken');

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
Route::get('/booking', [CustomerController::class, 'showBooking'])->name('booking');
Route::post('/booking', [CustomerController::class, 'storeBooking'])->name('booking.post');
Route::get('/tracking', [CustomerController::class, 'showTracking'])->name('tracking');

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('customer.profile.index');
    Route::get('/profile/update', [ProfileController::class, 'editProfile'])->name('customer.profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/my-orders', [CustomerController::class, 'showOrders'])->name('customer.orders.index');
});

// ============================================================
// ADMIN ROUTES
// ============================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Public
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware(['auth:admin'])->group(function () {

        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Orders
        Route::get('/orders', [AdminController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/assign', [AdminController::class, 'assignAgent'])->name('orders.assign');

        // User Account (admin profile) — HOẠT ĐỘNG THẬT
        Route::get('/account', [AdminController::class, 'account'])->name('account');
        Route::put('/account/username', [AdminController::class, 'updateUsername'])->name('account.username');
        Route::put('/account/password', [AdminController::class, 'updatePassword'])->name('account.password');

        // Agent Management (CRUD thật từ DB)
        Route::get('/agents', [AdminController::class, 'agentsIndex'])->name('agents.index');
        Route::post('/agents', [AdminController::class, 'agentsStore'])->name('agents.store');
        Route::get('/agents/{id}', [AdminController::class, 'agentsShow'])->name('agents.show');
        Route::put('/agents/{id}', [AdminController::class, 'agentsUpdate'])->name('agents.update');
        Route::patch('/agents/{id}/status', [AdminController::class, 'agentsUpdateStatus'])->name('agents.status');
        Route::delete('/agents/{id}', [AdminController::class, 'agentsDestroy'])->name('agents.destroy');

        // Customers
        Route::get('/customers/{id}/overview', [AdminController::class, 'customerOverview'])->name('customers.overview');
        Route::get('/customers/{id}/security', [AdminController::class, 'customerSecurity'])->name('customers.security');
        Route::get('/customers/{id}/billing', [AdminController::class, 'customerBilling'])->name('customers.billing');
        Route::get('/customers/{id}/notifications', [AdminController::class, 'customerNotifications'])->name('customers.notifications');

        // Employees (demo)
        Route::get('/employees', [AdminController::class, 'employeesIndex'])->name('employees.index');
        Route::post('/employees', [AdminController::class, 'employeeStore'])->name('employees.store');
        Route::get('/employees/{id}', [AdminController::class, 'employeeShow'])->name('employees.show');
        Route::put('/employees/{id}', [AdminController::class, 'employeeUpdate'])->name('employees.update');
        Route::delete('/employees/{id}', [AdminController::class, 'employeeDestroy'])->name('employees.destroy');
    });
});

Route::get('/admin', function () {
    return auth()->guard('admin')->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('admin.login');
});

// ============================================================
// AGENT ROUTES
// ============================================================
Route::prefix('agent')->name('agent.')->group(function () {
    Route::get('/login',     [AgentController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AgentController::class, 'login'])->name('login.post');
    Route::get('/register',  [AgentController::class, 'showRegister'])->name('register');
    Route::post('/register', [AgentController::class, 'register'])->name('register.post');
    Route::post('/logout',   [AgentController::class, 'logout'])->name('logout');
});

Route::prefix('agent')->name('agent.')->middleware('auth:agent')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');

    // Orders
    Route::get('/orders', [AgentController::class, 'index'])->name('orders.index');

    // --- CHỈ SỬA THÊM 2 ROUTE NÀY CHO AGENT ---
    Route::get('/orders/by-time', [AgentController::class, 'byTime'])->name('orders.by-time');
    Route::get('/orders/by-status', [AgentController::class, 'byStatus'])->name('orders.by-status');
    // ------------------------------------------

    Route::get('/orders/{id}', [AgentController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/accept', [AgentController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{id}/complete', [AgentController::class, 'complete'])->name('orders.complete');
    Route::get('/couriers', [AgentController::class, 'couriersIndex'])->name('couriers.index');
    Route::get('/customers', [AgentController::class, 'customersIndex'])->name('customers.index');
    Route::get('/customers/{id}', [AgentController::class, 'customersShow'])->name('customers.show');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email'
    ]);

    Password::sendResetLink(
        $request->only('email')
    );
})->name('password.email');

Route::get('/custom-captcha', function () {

    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    $captcha = '';

    for ($i = 0; $i < 5; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }

    session(['custom_captcha' => $captcha]);

    $svg = '
    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="44">
        <rect width="100%" height="100%" fill="#ffffff"/>

        <text
            x="50%"
            y="50%"
            dominant-baseline="middle"
            text-anchor="middle"
            font-size="24"
            font-family="Arial"
            fill="#dc2626"
            font-weight="bold"
            letter-spacing="5"
        >
            ' . $captcha . '
        </text>
    </svg>';

    return response($svg)
        ->header('Content-Type', 'image/svg+xml');

})->name('custom.captcha');

Route::get('/faq', [CustomerController::class, 'showFaq'])->name('customer.faq');

// Đường dẫn tạm thời để dọn dẹp cache hệ thống trên Render
Route::get('/clear-all-cache', function () {
    // 1. Ép hệ thống xóa sạch tận gốc các file cache cấu hình cũ
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    try {
        // 2. Chạy lệnh migrate tạo các bảng dữ liệu cho CourierXpress sang Postgres
        Artisan::call('migrate', ['--force' => true]);
        return "Đã dọn dẹp cache và chạy Migration tạo bảng thành công!";
    } catch (\Exception $e) {
        return "Lỗi khi chạy Migrate: " . $e->getMessage();
    }
});
