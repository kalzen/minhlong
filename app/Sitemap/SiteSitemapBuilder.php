<?php

namespace App\Sitemap;

use App\Models\LibraryDocument;
use App\Models\Post;
use App\Support\SitePages;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteSitemapBuilder
{
    /**
     * How long a written sitemap.xml stays trusted before it is rebuilt on request.
     */
    private const MAX_AGE_SECONDS = 3600;

    /**
     * Crawl weighting per page key from config/site_pages.php.
     *
     * @var array<string, array{priority: float, changeFrequency: string}>
     */
    private const PAGE_WEIGHTS = [
        'home' => ['priority' => 1.0, 'changeFrequency' => Url::CHANGE_FREQUENCY_WEEKLY],
        'about' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'services' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'land' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'power' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'host' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'minerals' => ['priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'blog' => ['priority' => 0.9, 'changeFrequency' => Url::CHANGE_FREQUENCY_DAILY],
        'contact' => ['priority' => 0.7, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        'library' => ['priority' => 0.7, 'changeFrequency' => Url::CHANGE_FREQUENCY_WEEKLY],
    ];

    public function build(): Sitemap
    {
        $sitemap = Sitemap::create();

        $pages = SitePages::all();
        $locales = SitePages::locales();

        // One entry per language per page, each declaring its siblings via
        // hreflang so search engines treat them as translations rather than
        // duplicates.
        foreach (self::PAGE_WEIGHTS as $pageKey => $weight) {
            if (! isset($pages[$pageKey])) {
                continue;
            }

            $baseName = $pages[$pageKey]['name'];

            foreach ($locales as $locale) {
                $routeName = SitePages::routeName($baseName, $locale);

                if (! Route::has($routeName)) {
                    continue;
                }

                $url = Url::create(route($routeName))
                    ->setPriority($weight['priority'])
                    ->setChangeFrequency($weight['changeFrequency']);

                foreach ($locales as $alternateLocale) {
                    $alternateName = SitePages::routeName($baseName, $alternateLocale);

                    if ($alternateLocale !== $locale && Route::has($alternateName)) {
                        $url->addAlternate(route($alternateName), $alternateLocale);
                    }
                }

                $sitemap->add($url);
            }
        }

        if (Schema::hasTable('posts')) {
            Post::query()
                ->where('status', 'published')
                ->orderByDesc('updated_at')
                ->get()
                ->each(fn (Post $post) => $sitemap->add($post));
        }

        return $sitemap;
    }

    public function writeToPublic(): void
    {
        $this->build()->writeToFile($this->path());
    }

    /**
     * Rebuild the file only when it is missing, older than the freshness window,
     * or older than the newest published content.
     */
    public function refreshIfStale(): void
    {
        if ($this->isStale()) {
            $this->writeToPublic();
        }
    }

    public function isStale(): bool
    {
        $path = $this->path();

        if (! is_file($path)) {
            return true;
        }

        $writtenAt = (int) filemtime($path);

        if ($writtenAt + self::MAX_AGE_SECONDS < time()) {
            return true;
        }

        return $writtenAt < $this->latestContentTimestamp();
    }

    /**
     * Drop the cached file so the next request (or command) regenerates it.
     */
    public function invalidate(): void
    {
        $path = $this->path();

        if (is_file($path)) {
            @unlink($path);
        }
    }

    public function path(): string
    {
        return public_path('sitemap.xml');
    }

    private function latestContentTimestamp(): int
    {
        $latest = 0;

        if (Schema::hasTable('posts')) {
            $latest = max($latest, (int) (Post::query()->max('updated_at')
                ? strtotime((string) Post::query()->max('updated_at'))
                : 0));
        }

        if (Schema::hasTable('library_documents')) {
            $latest = max($latest, (int) (LibraryDocument::query()->max('updated_at')
                ? strtotime((string) LibraryDocument::query()->max('updated_at'))
                : 0));
        }

        return $latest;
    }
}
