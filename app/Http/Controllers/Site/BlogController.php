<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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

    public function show(string $slug): View|Response
    {
        $locale = app()->getLocale();

        $post = Post::query()
            ->where('status', 'published')
            ->forLocale($locale)
            ->where('slug', $slug)
            ->with('category')
            ->firstOrFail();

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
