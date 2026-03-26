<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'banner',
        'banner_title',
        'description',
        'meta_description',
        'order',
        'active',
    ];

    // Add any relationships or custom methods as needed
}
