<?php

namespace misCursos\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \misCursos\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \misCursos\Http\Middleware\VerifyCsrfToken::class,
        \misCursos\Http\Middleware\LogDatabaseQueries::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \misCursos\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \misCursos\Http\Middleware\RedirectIfAuthenticated::class,
        'student' => \misCursos\Http\Middleware\Student::class,
        'admin' => \misCursos\Http\Middleware\Admin::class,
        'teach' => \misCursos\Http\Middleware\Teach::class,
        'adviser' => \misCursos\Http\Middleware\Adviser::class,

    ];
}
