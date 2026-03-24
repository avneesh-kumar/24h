<?php

namespace App\Services\Settings;

class GeneralSettingsService extends BaseSettingsService
{
    public function getSiteName()
    {
        return $this->get('site_name', config('app.name'));
    }

    public function setSiteName($name)
    {
        return $this->set('site_name', $name);
    }

    public function getTimezone()
    {
        return $this->get('timezone', config('app.timezone'));
    }

    public function setTimezone($timezone)
    {
        return $this->set('timezone', $timezone);
    }

    public function getLogoPath()
    {
        return $this->get('site_logo', null);
    }

    public function setLogoPath($path)
    {
        return $this->set('site_logo', $path);
    }

    public function getAddress()
    {
        return $this->get('address', '');
    }

    public function setAddress($address)
    {
        return $this->set('address', $address);
    }

    public function getCity()
    {
        return $this->get('city', '');
    }

    public function setCity($city)
    {
        return $this->set('city', $city);
    }

    public function getState()
    {
        return $this->get('state', '');
    }

    public function setState($state)
    {
        return $this->set('state', $state);
    }

    public function getZipCode()
    {
        return $this->get('zip_code', '');
    }

    public function setZipCode($zipCode)
    {
        return $this->set('zip_code', $zipCode);
    }

    public function getLatitude()
    {
        return $this->get('latitude', '');
    }

    public function setLatitude($latitude)
    {
        return $this->set('latitude', $latitude);
    }

    public function getLongitude()
    {
        return $this->get('longitude', '');
    }

    public function setLongitude($longitude)
    {
        return $this->set('longitude', $longitude);
    }
}
