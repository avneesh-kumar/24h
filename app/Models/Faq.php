<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'sort_order'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
