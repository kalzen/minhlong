<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Imports remote images from AI Marketing into Spatie collections and replaces
 * placeholders such as {{IMAGE_URL_1}} in post HTML with real media URLs.
 */
final class PostAimarketingImageSync
{
    /**
     * @param  list<string>  $urls
     */
    public static function sync(Post $post, array $urls): void
    {
        $urls = array_values(array_filter(
            $urls,
            static fn ($u): bool => is_string($u) && trim($u) !== ''
        ));

        $shouldDownload = $urls !== [] && $post->getFirstMedia('featured') === null;

        if ($shouldDownload) {
            foreach ($urls as $i => $url) {
                $url = trim($url);
                $collection = $i === 0 ? 'featured' : 'content';
                self::attachFromRemoteUrl($post, $url, $collection);
            }
            $post->refresh();
        }

        $map = self::placeholderIndexToUrl($post);
        if ($map === []) {
            return;
        }

        $body = $post->content;
        if (! is_string($body) || $body === '') {
            return;
        }

        $newBody = self::replaceImagePlaceholders($body, $map);
        if ($newBody !== $body) {
            $post->content = $newBody;
            $post->save();
        }
    }

    /**
     * @return array<int, string> 1-based index => absolute URL
     */
    private static function placeholderIndexToUrl(Post $post): array
    {
        $map = [];
        $featuredUrl = $post->getFirstMediaUrl('featured');
        if (is_string($featuredUrl) && $featuredUrl !== '') {
            $map[1] = $featuredUrl;
        }

        $i = 2;
        foreach ($post->getMedia('content') as $media) {
            $url = $media->getUrl();
            if (is_string($url) && $url !== '') {
                $map[$i] = $url;
            }
            $i++;
        }

        return $map;
    }

    /**
     * @param  array<int, string>  $indexToUrl
     */
    public static function replaceImagePlaceholders(string $html, array $indexToUrl): string
    {
        return (string) preg_replace_callback(
            '/\{\{\s*IMAGE_URL_(\d+)\s*\}\}/i',
            static function (array $m) use ($indexToUrl): string {
                $n = (int) $m[1];

                return $indexToUrl[$n] ?? $m[0];
            },
            $html
        );
    }

    private static function attachFromRemoteUrl(Post $post, string $url, string $collection): void
    {
        try {
            $response = Http::timeout(120)->retry(2, 500)->get($url);
            if (! $response->successful()) {
                return;
            }

            $path = parse_url($url, PHP_URL_PATH) ?: '';
            $basename = basename($path) ?: 'image.jpg';
            if (! str_contains($basename, '.')) {
                $basename .= '.jpg';
            }

            $basename = Str::ascii($basename) ?: 'image.jpg';

            $tmp = tempnam(sys_get_temp_dir(), 'ml_ai_img_');
            if ($tmp === false) {
                return;
            }

            file_put_contents($tmp, $response->body());

            try {
                $post->addMedia($tmp)->usingFileName($basename)->toMediaCollection($collection);
            } finally {
                @unlink($tmp);
            }
        } catch (\Throwable) {
            // Remote image optional; placeholders may remain.
        }
    }
}
