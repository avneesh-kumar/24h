<?php
namespace App\Services\Settings;
class UserSettingsService extends BaseSettingsService
{
    public function registrationEnabled() { return (bool) $this->get('registration_enabled', true); }
    public function emailVerification() { return (bool) $this->get('email_verification', true); }
    public function passwordMinLength() { return (int) $this->get('password_min_length', 8); }
    public function passwordComplexity() { return $this->get('password_complexity', 'letters_numbers'); }
}
