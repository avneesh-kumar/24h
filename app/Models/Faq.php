<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'sort_order', 'group_name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
