<?php

namespace App\Services\Settings;

class PerformanceSettingsService extends BaseSettingsService
{
    public function getEnableMinify()
    {
        return (bool) $this->get('enable_minify', false);
    }

    public function setEnableMinify($enabled)
    {
        return $this->set('enable_minify', $enabled);
    }

    public function getEnableLazyLoad()
    {
        return (bool) $this->get('enable_lazy_load', true);
    }

    public function setEnableLazyLoad($enabled)
    {
        return $this->set('enable_lazy_load', $enabled);
    }
}
