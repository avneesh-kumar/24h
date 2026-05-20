<?php

if (!function_exists('app_timezone')) {
    /**
     * Get the application timezone from database settings or config fallback
     * 
     * @return string
     */
    function app_timezone(): string
    {
        try {
            // Try to get from database settings
            $timezone = app(\App\Services\Settings\GeneralSettingsService::class)->getTimezone();
            return $timezone ?: config('app.timezone', 'UTC');
        } catch (\Exception $e) {
            // Fallback to config if database not available (e.g., during migrations)
            return config('app.timezone', 'UTC');
        }
    }
}

if (!function_exists('current_time_in_app_timezone')) {
    /**
     * Get current time in application timezone
     * 
     * @param string $format
     * @return string
     */
    function current_time_in_app_timezone(string $format = 'Y-m-d H:i:s'): string
    {
        return now()->timezone(app_timezone())->format($format);
    }
}
