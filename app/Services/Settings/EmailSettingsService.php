<?php
namespace App\Services\Settings;
class EmailSettingsService extends BaseSettingsService
{
    public function fromName() { return $this->get('from_name', 'Admin'); }
    public function fromAddress() { return $this->get('from_address', 'admin@example.com'); }
    public function smtpHost() { return $this->get('smtp_host', ''); }
    public function smtpPort() { return (int) $this->get('smtp_port', 587); }
    public function smtpEncryption() { return $this->get('smtp_encryption', 'tls'); }
    public function smtpUsername() { return $this->get('smtp_username', ''); }
    public function smtpPassword() { return $this->get('smtp_password', ''); }
}
