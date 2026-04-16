<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'translation_group_id',
        'locale',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail_path',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'created_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('content')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! extension_loaded('gd') && ! extension_loaded('imagick')) {
            return;
        }

        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(400)
            ->nonQueued();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return Collection<int, Post>
     */
    public function translationSiblings(): Collection
    {
        if ($this->translation_group_id === null) {
            return collect();
        }

        return self::query()
            ->where('translation_group_id', $this->translation_group_id)
            ->where('id', '!=', $this->id)
            ->get();
    }

    public function scopeForLocale(Builder $query, ?string $locale = null): Builder
    {
        return $query->where('locale', $locale ?? app()->getLocale());
    }

    /**
     * Eager-load featured images for listing cards (avoids N+1 when resolving URLs).
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeWithFeaturedMedia(Builder $query): Builder
    {
        return $query->with(['media' => function ($mediaQuery): void {
            $mediaQuery->where('collection_name', 'featured');
        }]);
    }

    /**
     * Public URL for the representative image: Spatie `featured` media first, then legacy `thumbnail_path`.
     * Returns null when neither resolves (callers use default placeholder images).
     */
    public function publicFeaturedImageUrl(): ?string
    {
        $fromMedia = $this->getFirstMediaUrl('featured');
        if (is_string($fromMedia) && $fromMedia !== '') {
            return $fromMedia;
        }

        $path = $this->thumbnail_path;
        if (! filled($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (is_file(public_path($path))) {
            return asset($path);
        }

        return null;
    }
}
