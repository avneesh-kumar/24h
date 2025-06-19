<?php
return [
    'from_name' => [
        'label' => 'From Name',
        'type' => 'string',
        'default' => 'Admin',
        'description' => 'Default sender name for outgoing emails.'
    ],
    'from_address' => [
        'label' => 'From Email Address',
        'type' => 'string',
        'default' => 'admin@example.com',
        'description' => 'Default sender email address.'
    ],
    'smtp_host' => [
        'label' => 'SMTP Host',
        'type' => 'string',
        'default' => '',
        'description' => 'SMTP server host.'
    ],
    'smtp_port' => [
        'label' => 'SMTP Port',
        'type' => 'int',
        'default' => 587,
        'description' => 'SMTP server port.'
    ],
    'smtp_encryption' => [
        'label' => 'SMTP Encryption',
        'type' => 'select',
        'options' => [
            'tls' => 'TLS',
            'ssl' => 'SSL',
            'none' => 'None',
        ],
        'default' => 'tls',
        'description' => 'Encryption method for SMTP.'
    ],
    'smtp_username' => [
        'label' => 'SMTP Username',
        'type' => 'string',
        'default' => '',
        'description' => 'SMTP username.'
    ],
    'smtp_password' => [
        'label' => 'SMTP Password',
        'type' => 'string',
        'default' => '',
        'description' => 'SMTP password.'
    ],
];
