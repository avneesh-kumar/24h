<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class MaintenanceModeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Only enforce maintenance for non-admin routes
        if (
            !($request->is('admin/*') || $request->is('admin')) &&
            Setting::where('key', 'maintenance_mode')->value('value') === '1'
        ) {
            return response()->view('errors.503', [], 503);
        }
        return $next($request);
    }
}
