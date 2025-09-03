<?php

namespace App\Providers;

use App\Models\Admin; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
         Paginator::useBootstrap();
     Gate::define('use-translation-manager', function (?Admin $user) {
    return $user !== null && $user->hasRole('admin');
});
    }
}
