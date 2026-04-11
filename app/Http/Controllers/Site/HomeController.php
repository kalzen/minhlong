<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\LibraryDocument;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;
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

        $profileDocuments = collect();
        if (Schema::hasTable('library_documents')) {
            $profileDocuments = LibraryDocument::query()
                ->where('is_public', true)
                ->where('library_category', LibraryDocument::CATEGORY_PROFILE)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->filter(fn (LibraryDocument $doc) => $doc->getFirstMedia('file') !== null)
                ->values();
        }

        return view('site.home', [
            'title' => 'Home',
            'posts' => $posts,
            'profileDocuments' => $profileDocuments,
        ]);
    }
}
