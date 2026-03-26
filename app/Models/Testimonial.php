<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'company',
        'content',
        'rating',
        'image',
        'order',
        'active'
    ];

    protected $casts = [
        'rating' => 'integer',
        'active' => 'boolean',
        'order' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($testimonial) {
            if (empty($testimonial->order)) {
                $testimonial->order = static::max('order') + 1;
            }
        });
    }
} 