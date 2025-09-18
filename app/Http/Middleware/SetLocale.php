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
    {    // جِب اللغة من السيشن إذا موجودة
        $locale = Session::get('locale');

        // إذا مو موجودة بالسيشن وجاه مستخدم مسجل دخول → خُذ من البروفايل
        if (!$locale && Auth::check()) {
            $locale = Auth::user()->language ?? 'en';
        }

        // إذا لسا مو محددة → خليها إنكليزي افتراضي
        $locale = $locale ?? 'en';

        // طبّق اللغة
        App::setLocale($locale);

        return $next($request);
    }
}
