<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale');

        // إذا غير موجودة، استخدم لغة المستخدم إذا مسجل
        if (!$locale && Auth::check()) {
            $locale = Auth::user()->language ?? 'en';
        }

        // افتراضي
        $locale = $locale ?? 'en';

        // طبق اللغة على التطبيق
        App::setLocale($locale);

        return $next($request);
    }
    }

