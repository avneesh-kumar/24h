<?php
namespace App\Services\Settings;
class SecuritySettingsService extends BaseSettingsService
{
    public function forceHttps() { return (bool) $this->get('force_https', false); }
    public function getCspMode() { return $this->get('csp_mode', 'none'); }
    public function getXFrameOptions() { return $this->get('x_frame_options', 'sameorigin'); }
    public function xssProtection() { return (bool) $this->get('x_xss_protection', true); }
    public function getAdminSessionTimeout() { return (int) $this->get('admin_session_timeout', 60); }
}
