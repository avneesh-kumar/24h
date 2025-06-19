<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // ...existing code...
        \App\Http\Middleware\MaintenanceModeMiddleware::class,
        \App\Http\Middleware\MinifyHtmlMiddleware::class,
        \App\Http\Middleware\SecurityHeadersMiddleware::class,
    ];

    // ...existing code...
}
