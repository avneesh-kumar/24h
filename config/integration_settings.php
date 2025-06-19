<?php
return [
    'google_analytics_id' => [
        'label' => 'Google Analytics ID',
        'type' => 'string',
        'default' => '',
        'description' => 'Google Analytics or GA4 Measurement ID.'
    ],
    'google_tag_manager_id' => [
        'label' => 'Google Tag Manager ID',
        'type' => 'string',
        'default' => '',
        'description' => 'Google Tag Manager Container ID.'
    ],
    'facebook_pixel_id' => [
        'label' => 'Facebook Pixel ID',
        'type' => 'string',
        'default' => '',
        'description' => 'Facebook/Meta Pixel ID.'
    ],
    'custom_webhook_url' => [
        'label' => 'Custom Webhook URL',
        'type' => 'string',
        'default' => '',
        'description' => 'URL for custom webhook integrations.'
    ],
];
