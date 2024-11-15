<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Vite;
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
        //
        ini_set('memory_limit', '256M');
        Model::unguard();
        // Vite::prefetch();
    }
}
