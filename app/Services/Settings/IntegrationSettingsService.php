<?php
namespace App\Services\Settings;
class IntegrationSettingsService extends BaseSettingsService
{
    public function googleAnalyticsId() { return $this->get('google_analytics_id', ''); }
    public function googleTagManagerId() { return $this->get('google_tag_manager_id', ''); }
    public function facebookPixelId() { return $this->get('facebook_pixel_id', ''); }
    public function customWebhookUrl() { return $this->get('custom_webhook_url', ''); }
}
