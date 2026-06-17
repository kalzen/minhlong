<?php

namespace App\Models;

use App\Support\SiteMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Post extends Model implements HasMedia, Sitemapable
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
     * Admin listing: newest group activity first (max updated_at among siblings).
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeOrderByLatestTranslationGroupActivity(Builder $query): Builder
    {
        return $query
            ->orderByRaw(
                'COALESCE((
                    select max(grouped.updated_at)
                    from posts as grouped
                    where grouped.translation_group_id = posts.translation_group_id
                ), posts.updated_at) DESC'
            )
            ->orderByRaw('CASE WHEN translation_group_id IS NULL THEN 1 ELSE 0 END')
            ->orderBy('translation_group_id')
            ->orderBy('locale');
    }

    /**
     * Sort locale records by newest activity of their translation group first.
     *
     * For translated posts, the newest publish/create time among sibling locales
     * decides the group's position. Non-grouped posts still fall back to their own
     * publish/create time.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeOrderByLatestTranslationGroup(Builder $query): Builder
    {
        return $query
            ->orderByRaw(
                '(select max(coalesce(grouped.published_at, grouped.created_at))
                    from posts as grouped
                    where grouped.status = ?
                      and grouped.translation_group_id = posts.translation_group_id
                ) desc',
                ['published']
            )
            ->orderByRaw('COALESCE(published_at, created_at) DESC');
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

    public function toSitemapTag(): Url
    {
        $tag = Url::create(route('site.blog.show', ['slug' => $this->slug]))
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);

        if ($this->translation_group_id !== null) {
            $siblings = self::query()
                ->where('translation_group_id', $this->translation_group_id)
                ->where('status', 'published')
                ->whereKeyNot($this->getKey())
                ->get(['locale', 'slug']);

            foreach ($siblings as $sibling) {
                $tag->addAlternate(
                    route('site.blog.show', ['slug' => $sibling->slug]),
                    $sibling->locale
                );
            }
        }

        $featuredImage = $this->publicFeaturedImageUrl();
        if (filled($featuredImage)) {
            $tag->addImage(SiteMedia::absoluteUrl($featuredImage), $this->title);
        }

        return $tag;
    }
}
