<?php

use App\Models\Post;

test('blog index renders theme pagination markup when there are multiple pages', function () {
    foreach (range(1, 10) as $i) {
        Post::query()->create([
            'category_id' => null,
            'translation_group_id' => null,
            'locale' => app()->getLocale(),
            'title' => "Pagination post {$i}",
            'slug' => "pagination-post-{$i}",
            'excerpt' => 'e',
            'content' => '<p>c</p>',
            'status' => 'published',
            'published_at' => now()->subMinutes($i),
        ]);
    }

    $this->get(route('site.blog.index'))
        ->assertOk()
        ->assertSee('page-pagination', false)
        ->assertSee('page-pagination-list', false)
        ->assertSee('rel="next"', false)
        ->assertSee('class="active"', false)
        ->assertDontSee('fa-angle-right', false);
});
