<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\PrivacyPolicy;
use App\Policies\PostPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        PrivacyPolicy::class => PostPolicy::class, // ربط النموذج بالـ Policy
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('use-translation-manager', function ($user) {
            return $user !== null && $user->hasRole('admin');
        });
         app()->setLocale(session('locale', config('app.locale')));
    }
}
