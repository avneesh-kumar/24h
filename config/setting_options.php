<?php
return [
    'cache_driver' => [
        'file' => 'File',
        'redis' => 'Redis',
        'memcached' => 'Memcached',
        'database' => 'Database',
        'array' => 'Array',
    ],
    'canonical_url_mode' => [
        'auto' => 'Auto',
        'manual' => 'Manual',
        'disabled' => 'Disabled',
    ],
    'timezone' => array_combine(
        \DateTimeZone::listIdentifiers(),
        array_map(function($tz) {
            return str_replace('_', ' ', $tz);
        }, \DateTimeZone::listIdentifiers())
    ),
    'x_frame_options' => [
        'DENY' => 'DENY',
        'SAMEORIGIN' => 'SAMEORIGIN',
        'ALLOW-FROM' => 'ALLOW-FROM',
    ],
    'log_level' => [
        'debug' => 'Debug',
        'info' => 'Info',
        'notice' => 'Notice',
        'warning' => 'Warning',
        'error' => 'Error',
        'critical' => 'Critical',
        'alert' => 'Alert',
        'emergency' => 'Emergency',
    ],
    'mail_encryption' => [
        'tls' => 'TLS',
        'ssl' => 'SSL',
        '' => 'None',
    ],
    'default_language' => [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'it' => 'Italian',
        'pt' => 'Portuguese',
        'ru' => 'Russian',
        'zh' => 'Chinese',
        'ja' => 'Japanese',
        'ko' => 'Korean',
    ],
    'image_formats_allowed' => [
        'jpg,png' => 'JPG, PNG',
        'jpg,png,webp' => 'JPG, PNG, WebP',
        'jpg,png,webp,avif' => 'JPG, PNG, WebP, AVIF',
    ],
    'content_security_policy' => [
        'default' => 'Default (Recommended)',
        'strict' => 'Strict',
        'custom' => 'Custom',
    ],
    'password_complexity' => [
        '0' => 'Basic (Letters and Numbers)',
        '1' => 'Standard (Letters, Numbers, Special Characters)',
        '2' => 'Strong (Uppercase, Lowercase, Numbers, Special Characters)',
    ],
];
