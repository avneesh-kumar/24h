<?php
namespace App\Services\Settings;
class AdvancedSettingsService extends BaseSettingsService
{
    public function getCustomHeadHtml() { return $this->get('custom_head_html', ''); }
    public function getCustomBodyEndHtml() { return $this->get('custom_body_end_html', ''); }
}
