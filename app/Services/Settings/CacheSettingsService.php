<?php

namespace App\Services\Settings;

class CacheSettingsService extends BaseSettingsService
{
    public function getCacheDriver()
    {
        return $this->get('cache_driver', config('cache.default'));
    }

    public function setCacheDriver($driver)
    {
        return $this->set('cache_driver', $driver);
    }

    public function getCacheTtl()
    {
        return $this->get('cache_ttl', 3600);
    }

    public function setCacheTtl($ttl)
    {
        return $this->set('cache_ttl', $ttl);
    }
}
