<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

abstract class BaseSettingsService
{
    protected function get($key, $default = null)
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    protected function set($key, $value)
    {
        $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting.{$key}");
        return $setting;
    }

    protected function clearCache($key)
    {
        Cache::forget("setting.{$key}");
    }
}
