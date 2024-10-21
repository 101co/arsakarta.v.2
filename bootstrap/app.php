<?php

use Illuminate\Foundation\Application;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function ($request, Exception $exception) {
        //         Notification::make()
        //             ->title('Terjadi Kesalahan')
        //             ->body($exception->getMessage())
        //             ->danger() // Atur notifikasi sebagai berbahaya (merah)
        //             ->send();
        //     // return parent::render($request, $exception);
        // });
    })->create();
