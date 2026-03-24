<?php

namespace App\Services\Settings;

class ImageSettingsService extends BaseSettingsService
{
    public function getImageQuality()
    {
        return $this->get('image_quality', 80);
    }

    public function setImageQuality($quality)
    {
        return $this->set('image_quality', $quality);
    }

    public function getImageFormat()
    {
        return $this->get('image_format', 'webp');
    }

    public function setImageFormat($format)
    {
        return $this->set('image_format', $format);
    }
}
