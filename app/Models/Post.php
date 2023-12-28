<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'title',
        'slug',
        'content',
        'publish_at',
        'featured'
    ];

    protected $casts = [
        'publish_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like_post')->withTimestamps();
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    public function scopePublished($query)
    {
        $query->where('publish_at', '<=', Carbon::now());
    }

    public function scopeWithTag($query, string $tag)
    {
        $query->whereHas('tags', function ($query) use ($tag){
            $query->where('slug', $tag);
        });
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage ::url($this->image);
    }
}
