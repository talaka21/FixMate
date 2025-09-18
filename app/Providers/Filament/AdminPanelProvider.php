<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Kenepa\TranslationManager\TranslationManagerPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
       return $panel
    ->default()
    ->id('admin')
    ->path('filament/admin/auth')
    ->authGuard('admin')
    ->login()
    ->colors([
        'primary' => Color::Purple,
    ])
    ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
    ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
    ->pages([
        Pages\Dashboard::class,
    ])
    ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
    ->widgets([
        Widgets\AccountWidget::class,
        Widgets\FilamentInfoWidget::class,
    ])
    ->plugins([
        // Translation Manager
    TranslationManagerPlugin::make(),

        // Profile Plugin
        FilamentEditProfilePlugin::make()
            ->setTitle('profile')
            ->setNavigationLabel('profile')
            ->setIcon('heroicon-o-user')
            ->setSort(10)
            ->shouldRegisterNavigation(true)
            ->shouldShowAvatarForm(
                value: true,
                directory: 'avatars',             // يخزن الصور داخل storage/app/public/avatars
                rules: 'mimes:jpeg,png,jpg|max:2048'
            )
            ->shouldShowBrowserSessionsForm()
            ->shouldShowSanctumTokens()
    ])
    ->middleware([
         \App\Http\Middleware\FilamentSetLocale::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
        DisableBladeIconComponents::class,
        DispatchServingFilamentEvent::class,
    ])
    ->authMiddleware([
        Authenticate::class,
    ]);

}
}
