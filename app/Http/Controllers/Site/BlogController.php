<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('site.blog.index', [
            'title' => 'Blog',
            'posts' => $posts,
        ]);
    }

    public function show(string $slug): View|\Illuminate\Http\Response
    {
        $post = Post::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        return view('site.blog.show', [
            'title' => $post->meta_title ?? $post->title,
            'metaDescription' => $post->meta_description ?? $post->excerpt,
            'post' => $post,
        ]);
    }
}
