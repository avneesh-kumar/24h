<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'order',
        'active',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($industry) {
            if (empty($industry->slug) && !empty($industry->title)) {
                $baseSlug = Str::slug($industry->title);
                $slug = $baseSlug;
                $i = 1;
                while (Industry::where('slug', $slug)->where('id', '!=', $industry->id)->exists()) {
                    $slug = $baseSlug . '-' . $i++;
                }
                $industry->slug = $slug;
            }
        });
    }
} 