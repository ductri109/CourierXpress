<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ép Laravel luôn sinh link HTTPS khi chạy trên máy chủ Render
        if (config('app.env') === 'production' || env('DATABASE_URL')) {
            URL::forceScheme('https');
        }
    }
}
