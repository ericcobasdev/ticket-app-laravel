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
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Middlewares personalizados
        $middleware->alias([
            'is.admin' => \App\Http\Middleware\IsAdmin::class,
            'is.technician' => \App\Http\Middleware\IsTechnician::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson() || $request->isXmlHttpRequest()) {
                return response()->json(['message' => 'Página no encontrada.'], 404);
            }
    
            // Si es Inertia, redirige a una vista 404 personalizada
            return Inertia\Inertia::render('Errors/NotFound')->toResponse($request)->setStatusCode(404);
        });
    })->create();  
