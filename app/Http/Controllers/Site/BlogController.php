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
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('site.blog.index', [
            'title' => 'Blog',
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
            ->with('category')
            ->first();

        if (! $post instanceof Post) {
            $otherLocalePost = Post::query()
                ->where('status', 'published')
                ->where('slug', $slug)
                ->first();

            if ($otherLocalePost instanceof Post && $otherLocalePost->translation_group_id !== null) {
                $localized = Post::query()
                    ->where('status', 'published')
                    ->where('locale', $locale)
                    ->where('translation_group_id', $otherLocalePost->translation_group_id)
                    ->first();

                if ($localized instanceof Post) {
                    return redirect()->route('site.blog.show', ['slug' => $localized->slug]);
                }
            }

            abort(404);
        }

        $alternates = [];
        if ($post->translation_group_id !== null) {
            $siblings = Post::query()
                ->where('translation_group_id', $post->translation_group_id)
                ->where('status', 'published')
                ->get(['locale', 'slug']);

            foreach ($siblings as $row) {
                $alternates[$row->locale] = route('site.blog.show', ['slug' => $row->slug]);
            }
        }

        return view('site.blog.show', [
            'title' => $post->meta_title ?? $post->title,
            'metaDescription' => $post->meta_description ?? $post->excerpt,
            'post' => $post,
            'hreflangAlternates' => $alternates,
        ]);
    }
}
