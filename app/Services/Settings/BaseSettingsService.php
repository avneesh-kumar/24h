<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

abstract class BaseSettingsService
{
    protected function get($key, $default = null)
    {
        try {
            return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
                return $this->getSettingValue($key, $default);
            });
        } catch (QueryException $e) {
            return $this->getSettingValue($key, $default);
        }
    }

    protected function set($key, $value)
    {
        if (! Schema::hasTable('settings')) {
            return null;
        }

        $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);

        try {
            Cache::forget("setting.{$key}");
        } catch (QueryException $e) {
            // Ignore cache backend errors during setup.
        }

        return $setting;
    }

    protected function clearCache($key)
    {
        try {
            Cache::forget("setting.{$key}");
        } catch (QueryException $e) {
            // Ignore cache backend errors during setup.
        }
    }

    protected function getSettingValue($key, $default = null)
    {
        if (! Schema::hasTable('settings')) {
            return $default;
        }

        $setting = Setting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}
