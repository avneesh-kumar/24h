<?php
return [
    'registration_enabled' => [
        'label' => 'Enable Registration',
        'type' => 'bool',
        'default' => true,
        'description' => 'Allow new users to register.'
    ],
    'email_verification' => [
        'label' => 'Require Email Verification',
        'type' => 'bool',
        'default' => true,
        'description' => 'Require users to verify their email address.'
    ],
    'password_min_length' => [
        'label' => 'Password Minimum Length',
        'type' => 'int',
        'default' => 8,
        'description' => 'Minimum password length for users.'
    ],
    'password_complexity' => [
        'label' => 'Password Complexity',
        'type' => 'select',
        'options' => [
            'none' => 'None',
            'letters_numbers' => 'Letters & Numbers',
            'letters_numbers_symbols' => 'Letters, Numbers & Symbols',
        ],
        'default' => 'letters_numbers',
        'description' => 'Password complexity requirements.'
    ],
];
