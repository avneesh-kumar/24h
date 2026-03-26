<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Page Builder Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure the page builder settings.
    |
    */

    'sections' => [
        'hero' => [
            'name' => 'Hero Section',
            'icon' => 'fas fa-star',
            'fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'required' => true,
                ],
                'buttonText' => [
                    'type' => 'text',
                    'label' => 'Button Text',
                    'required' => false,
                ],
                'buttonUrl' => [
                    'type' => 'text',
                    'label' => 'Button URL',
                    'required' => false,
                ],
            ],
        ],
        'features' => [
            'name' => 'Features Section',
            'icon' => 'fas fa-list',
            'fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Section Title',
                    'required' => true,
                ],
                'features' => [
                    'type' => 'repeater',
                    'label' => 'Features',
                    'fields' => [
                        'title' => [
                            'type' => 'text',
                            'label' => 'Feature Title',
                            'required' => true,
                        ],
                        'description' => [
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => true,
                        ],
                        'icon' => [
                            'type' => 'text',
                            'label' => 'Icon Class',
                            'required' => false,
                        ],
                    ],
                ],
            ],
        ],
        'testimonials' => [
            'name' => 'Testimonials Section',
            'icon' => 'fas fa-comments',
            'fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Section Title',
                    'required' => true,
                ],
                'testimonials' => [
                    'type' => 'repeater',
                    'label' => 'Testimonials',
                    'fields' => [
                        'name' => [
                            'type' => 'text',
                            'label' => 'Name',
                            'required' => true,
                        ],
                        'position' => [
                            'type' => 'text',
                            'label' => 'Position',
                            'required' => false,
                        ],
                        'content' => [
                            'type' => 'textarea',
                            'label' => 'Testimonial',
                            'required' => true,
                        ],
                        'image' => [
                            'type' => 'image',
                            'label' => 'Image',
                            'required' => false,
                        ],
                    ],
                ],
            ],
        ],
    ],
]; 