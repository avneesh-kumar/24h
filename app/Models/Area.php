<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'banner',
        'banner_title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'order',
        'active',
        'icon',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($area) {
            if (empty($area->slug)) {
                $area->slug = Str::slug($area->title);
            }
        });

        static::updating(function ($area) {
            if ($area->isDirty('title') && !$area->isDirty('slug')) {
                $area->slug = Str::slug($area->title);
            }
        });
    }
}
