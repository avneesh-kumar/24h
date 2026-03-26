<?php
return [
    'force_https' => [
        'label' => 'Force HTTPS',
        'type' => 'bool',
        'default' => false,
        'description' => 'Redirect all requests to HTTPS.'
    ],
    'csp_mode' => [
        'label' => 'Content Security Policy',
        'type' => 'select',
        'options' => [
            'none' => 'None',
            'strict' => 'Strict',
            'custom' => 'Custom',
        ],
        'default' => 'none',
        'description' => 'Set the Content Security Policy mode.'
    ],
    'x_frame_options' => [
        'label' => 'X-Frame-Options',
        'type' => 'select',
        'options' => [
            'deny' => 'Deny',
            'sameorigin' => 'Same Origin',
            'allow' => 'Allow All',
        ],
        'default' => 'sameorigin',
        'description' => 'Control if your site can be embedded in iframes.'
    ],
    'x_xss_protection' => [
        'label' => 'X-XSS-Protection',
        'type' => 'bool',
        'default' => true,
        'description' => 'Enable XSS protection headers.'
    ],
    'admin_session_timeout' => [
        'label' => 'Admin Session Timeout (minutes)',
        'type' => 'int',
        'default' => 60,
        'description' => 'How long before admin sessions expire.'
    ],
];
