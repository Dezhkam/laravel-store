<?php

namespace App\Models\Content;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes,HasPersianSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    protected $fillable = ['name','description','slug','image','status','tags'];
}
