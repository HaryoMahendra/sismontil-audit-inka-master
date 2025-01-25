<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class SetPageTitle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{
    $titles = [
        'dashboard' => 'Dashboard - SIM-TL',
        'laporan' => 'Laporan - SIM-TL',
        'users.index' => 'Daftar Pengguna - SIM-TL',
    ];

    $routeName = Route::currentRouteName();
    view()->share('pageTitle', $titles[$routeName] ?? 'SIM-TL');

    return $next($request);
}
}
