<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Gabungkan semua alias middleware di sini
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'role'  => \App\Http\Middleware\CheckRole::class,
        ]);
        
        $middleware->redirectUsersTo(function () {
            if (\Illuminate\Support\Facades\Auth::check()) {
                if (\Illuminate\Support\Facades\Auth::user()->role === 'admin_opd') {
                    return route('admin.opd.dashboard');
                }
                return route('admin.dashboard');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();