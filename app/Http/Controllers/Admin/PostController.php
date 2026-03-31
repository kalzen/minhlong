<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(Request $request): Response
    {
        $posts = Post::query()
            ->with('category')
            ->when($request->string('locale')->toString(), fn ($q, $locale) => $q->where('locale', $locale))
            ->latest('updated_at')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('admin/Posts/Index', [
            'posts' => $posts,
            'filters' => [
                'locale' => $request->string('locale')->toString() ?: null,
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Posts/Edit', [
            'post' => null,
            'categories' => PostCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, null);
        if (empty($data['translation_group_id'])) {
            $data['translation_group_id'] = (string) Str::uuid();
        }
        $post = Post::query()->create($data + ['created_by' => $request->user()?->id]);

        if ($request->hasFile('featured')) {
            $post->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post created.');
    }

    public function edit(Post $post): Response
    {
        $post->load('category');

        return Inertia::render('admin/Posts/Edit', [
            'post' => [
                'id' => $post->id,
                'category_id' => $post->category_id,
                'translation_group_id' => $post->translation_group_id,
                'locale' => $post->locale,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'status' => $post->status,
                'published_at' => $post->published_at?->format('Y-m-d\TH:i'),
                'meta_title' => $post->meta_title,
                'meta_description' => $post->meta_description,
                'featured_url' => $post->getFirstMediaUrl('featured') ?: null,
            ],
            'categories' => PostCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validated($request, $post);
        $post->update($data);

        if ($request->hasFile('featured')) {
            $post->clearMediaCollection('featured');
            $post->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Post $post): array
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:post_categories,id'],
            'translation_group_id' => ['nullable', 'uuid'],
            'locale' => ['required', 'string', 'max:8'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')
                    ->where(fn ($query) => $query->where('locale', $request->input('locale')))
                    ->ignore($post?->id),
            ],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'featured' => ['nullable', 'file', 'image', 'max:10240'],
        ]);

        unset($validated['featured']);

        if (($validated['translation_group_id'] ?? '') === '') {
            $validated['translation_group_id'] = null;
        }

        return $validated;
    }
}
