<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuth;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware)
    {
        $middleware->alias(
        [
            'auth'  => RedirectIfNotAuth::class,
            'guest' => RedirectIfAuthenticated::class, // ضفناها هنا
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions)
    {
        //
    })->create();
