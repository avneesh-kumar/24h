<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'type',
        'order',
        'content',
        'settings',
        'is_active'
    ];

    protected $casts = [
        'content' => 'array',
        'settings' => 'array',
        'is_active' => 'boolean'
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
