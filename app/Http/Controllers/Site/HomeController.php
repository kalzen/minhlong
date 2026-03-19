<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->with('category')
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('site.home', [
            'title' => 'Home',
            'posts' => $posts,
        ]);
    }
}
