<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $locale = app()->getLocale();

        $posts = Post::query()
            ->where('status', 'published')
            ->forLocale($locale)
            ->withFeaturedMedia()
            ->with('category')
            ->orderByLatestTranslationGroup()
            ->paginate(9);

        return view('site.blog.index', [
            'title' => __('site.seo.blog.title'),
            'metaDescription' => __('site.seo.blog.description'),
            'posts' => $posts,
        ]);
    }

    public function show(string $slug): View|RedirectResponse|Response
    {
        $locale = app()->getLocale();

        $post = Post::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->where('locale', $locale)
            ->withFeaturedMedia()
            ->with('category')
            ->first();

        if (! $post instanceof Post) {
            // The slug belongs to another language (or arrived on a legacy URL).
            // Send it to that post's own localized URL with a permanent redirect
            // so link equity follows the content instead of dead-ending in a 404.
            $otherLocalePost = Post::query()
                ->where('status', 'published')
                ->where('slug', $slug)
                ->first();

            if (! $otherLocalePost instanceof Post) {
                abort(404);
            }

            return redirect()->route(
                'site.blog.show.'.$otherLocalePost->locale,
                ['slug' => $otherLocalePost->slug],
                301
            );
        }

        $alternates = [];
        if ($post->translation_group_id !== null) {
            $siblings = Post::query()
                ->where('translation_group_id', $post->translation_group_id)
                ->where('status', 'published')
                ->get(['locale', 'slug']);

            foreach ($siblings as $row) {
                $alternates[$row->locale] = route('site.blog.show.'.$row->locale, ['slug' => $row->slug]);
            }
        }

        return view('site.blog.show', [
            'title' => $post->meta_title ?? $post->title,
            'metaDescription' => $post->meta_description ?? $post->excerpt,
            'post' => $post,
            'ogType' => 'article',
            'hreflangAlternates' => $alternates,
            'ogImageUrl' => $post->publicFeaturedImageUrl(),
        ]);
    }
}
