<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'publish_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->content),150);
    }

    public function scopePublished($query)
    {
        $query->where('publish_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured',true);
    }
}
