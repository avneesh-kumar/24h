<?php
namespace App\Http\Middleware;

use App\Services\Settings\SecuritySettingsService;
use Closure;

class SecurityHeadersMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $settings = app(SecuritySettingsService::class);

        // Force HTTPS
        if ($settings->forceHttps() && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        // X-Frame-Options
        $xFrame = $settings->getXFrameOptions();
        if ($xFrame !== 'allow') {
            $response->headers->set('X-Frame-Options', strtoupper($xFrame));
        }

        // X-XSS-Protection
        if ($settings->xssProtection()) {
            $response->headers->set('X-XSS-Protection', '1; mode=block');
        }

        // Content-Security-Policy
        $csp = $settings->getCspMode();
        if ($csp === 'strict') {
            $response->headers->set('Content-Security-Policy',
                "/default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; object-src 'none';/"
            );
        } elseif ($csp === 'custom') {
            // You can extend this to load a custom policy from settings
        }

        return $response;
    }
}
