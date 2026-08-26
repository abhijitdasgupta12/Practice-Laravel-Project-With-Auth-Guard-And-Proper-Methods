<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function ($request) {

            // API → never redirect
            if ($request->is('api/*')) {
                return null;
            }

            // Admin → admin login page
            if ($request->is('admin/*')) {
                return route('admin.login.page');
            }

            // Normal web user → user login page
            return route('user.login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //FOR UNAUTHORIZED ACCESS TO PROTECTED APIS
        $exceptions->shouldRenderJsonWhen(function ($request, $input) {
            return $request->is('api/*')
                || $request->expectsJson();
        });
    })->create();
