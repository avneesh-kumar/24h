<?php
namespace App\Services\Settings;
class LoggingSettingsService extends BaseSettingsService
{
    public function logLevel() { return $this->get('log_level', 'error'); }
    public function errorReportingEmail() { return $this->get('error_reporting_email', ''); }
    public function enableSlackReporting() { return (bool) $this->get('enable_slack_reporting', false); }
    public function slackWebhookUrl() { return $this->get('slack_webhook_url', ''); }
}
