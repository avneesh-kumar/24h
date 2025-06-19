<?php
namespace App\Services\Settings;
class BrandingSettingsService extends BaseSettingsService
{
    public function favicon() { return $this->get('favicon', ''); }
    public function primaryColor() { return $this->get('primary_color', '#ff0000'); }
    public function secondaryColor() { return $this->get('secondary_color', '#000000'); }
}
