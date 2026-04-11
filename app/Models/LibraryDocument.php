<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LibraryDocument extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const CATEGORY_PROFILE = 'profile';

    public const CATEGORY_REPORT = 'report';

    public const LINK_INTERNAL = 'internal';

    public const LINK_EXTERNAL = 'external';

    protected $fillable = [
        'title',
        'library_category',
        'is_public',
        'sort_order',
        'external_url',
        'link_type',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function hasDownloadTarget(): bool
    {
        if ($this->link_type === self::LINK_EXTERNAL) {
            return filled($this->external_url);
        }

        return $this->getFirstMedia('file') !== null;
    }

    public function isExternalLink(): bool
    {
        return $this->link_type === self::LINK_EXTERNAL;
    }

    /**
     * Public href for listing / modal: internal documents use the app download route; external use the stored URL.
     */
    public function publicDownloadHref(): string
    {
        if ($this->isExternalLink() && filled($this->external_url)) {
            return $this->external_url;
        }

        return route('site.library.download', $this);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')
            ->singleFile()
            ->acceptsMimeTypes([
                'text/csv',
                'text/plain',
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
    }
}
