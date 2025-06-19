<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

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
        'area_id',
        'icon',
        'image',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title') && !$service->isDirty('slug')) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    // Add any relationships or custom methods as needed
}
