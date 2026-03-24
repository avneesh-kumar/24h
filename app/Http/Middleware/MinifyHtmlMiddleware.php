<?php

namespace App\Http\Middleware;

use App\Services\Settings\PerformanceSettingsService;
use Closure;

class MinifyHtmlMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Only minify HTML responses
        if ($response instanceof \Illuminate\Http\Response &&
            strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $minify = app(PerformanceSettingsService::class)->getEnableMinify();
            if ($minify) {
                $content = $response->getContent();
                $content = preg_replace('/\s+/', ' ', $content);
                $content = preg_replace('/<!--.*?-->/', '', $content);
                $response->setContent($content);
            }
        }
        return $response;
    }
}
