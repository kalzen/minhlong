<?php

namespace App\Sitemap;

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteSitemapBuilder
{
    /**
     * @var list<array{name: string, priority: float, changeFrequency: string}>
     */
    private const STATIC_PAGES = [
        ['name' => 'home', 'priority' => 1.0, 'changeFrequency' => Url::CHANGE_FREQUENCY_WEEKLY],
        ['name' => 'site.about', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.services', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.land', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.power', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.host', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.minerals', 'priority' => 0.8, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.blog.index', 'priority' => 0.9, 'changeFrequency' => Url::CHANGE_FREQUENCY_DAILY],
        ['name' => 'site.contact', 'priority' => 0.7, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ['name' => 'site.library.index', 'priority' => 0.7, 'changeFrequency' => Url::CHANGE_FREQUENCY_WEEKLY],
    ];

    public function build(): Sitemap
    {
        $sitemap = Sitemap::create();

        foreach (self::STATIC_PAGES as $page) {
            if (! Route::has($page['name'])) {
                continue;
            }

            $sitemap->add(
                Url::create(route($page['name']))
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['changeFrequency'])
            );
        }

        Post::query()
            ->where('status', 'published')
            ->orderByDesc('updated_at')
            ->get()
            ->each(fn (Post $post) => $sitemap->add($post));

        return $sitemap;
    }

    public function writeToPublic(): void
    {
        $this->build()->writeToFile(public_path('sitemap.xml'));
    }
}
