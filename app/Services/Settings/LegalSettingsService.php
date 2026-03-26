<?php
namespace App\Services\Settings;
class LegalSettingsService extends BaseSettingsService
{
    public function privacyPolicyUrl() { return $this->get('privacy_policy_url', ''); }
    public function termsOfServiceUrl() { return $this->get('terms_of_service_url', ''); }
    public function cookieConsentEnabled() { return (bool) $this->get('cookie_consent_enabled', false); }
}
