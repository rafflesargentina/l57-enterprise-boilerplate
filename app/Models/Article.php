<?php

namespace Raffles\Models;

use Raffles\Models\Traits\ArticleTrait;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use ArticleTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'extract',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'slug',
        'title',
        'user_id',
        'published',
        'published_at',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = 'featured_photo';

    /**
     * Get the article category that owns the article.
     */
    public function article_category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    /**
     * Get the article's featured photo.
     */
    public function featured_photo()
    {
        return $this->morphOne(FeaturedPhoto::class, 'photoable')->withDefault();
    }

    /**
     * Get the article's photos.
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    /**
     * Get all of the article's unfeatured photos.
     */
    public function unfeatured_photos()
    {
        return $this->morphMany(UnfeaturedPhoto::class, 'photoable');
    }

    /**
     * Get the article that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
