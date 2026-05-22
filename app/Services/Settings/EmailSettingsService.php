<?php
namespace App\Services\Settings;
class EmailSettingsService extends BaseSettingsService
{
    public function fromName() { return $this->get('mail_from_name', 'Admin'); }
    public function fromAddress() { return $this->get('mail_from_address', 'admin@example.com'); }
    public function smtpHost() { return $this->get('mail_host', ''); }
    public function smtpPort() { return (int) $this->get('mail_port', 587); }
    public function smtpEncryption() { return $this->get('mail_encryption', 'tls'); }
    public function smtpUsername() { return $this->get('mail_username', ''); }
    public function smtpPassword() { return $this->get('mail_password', ''); }
}
