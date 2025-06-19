<?php
return [
    'log_level' => [
        'label' => 'Log Level',
        'type' => 'select',
        'options' => [
            'debug' => 'Debug',
            'info' => 'Info',
            'warning' => 'Warning',
            'error' => 'Error',
            'critical' => 'Critical',
        ],
        'default' => 'error',
        'description' => 'Minimum log level to record.'
    ],
    'error_reporting_email' => [
        'label' => 'Error Reporting Email',
        'type' => 'string',
        'default' => '',
        'description' => 'Send error reports to this email.'
    ],
    'enable_slack_reporting' => [
        'label' => 'Enable Slack Reporting',
        'type' => 'bool',
        'default' => false,
        'description' => 'Send error reports to Slack.'
    ],
    'slack_webhook_url' => [
        'label' => 'Slack Webhook URL',
        'type' => 'string',
        'default' => '',
        'description' => 'Webhook URL for Slack error reporting.'
    ],
];
