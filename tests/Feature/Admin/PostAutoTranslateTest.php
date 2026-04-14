<?php

use App\Ai\Agents\PostTranslationAgent;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Models\UserAiApiKey;

test('creating a post auto-generates missing locale translations with ai', function () {
    $user = User::factory()->create();
    $category = PostCategory::query()->create([
        'name' => 'Company News',
        'slug' => 'company-news',
        'status' => 'published',
    ]);

    UserAiApiKey::query()->create([
        'user_id' => $user->id,
        'provider' => 'openai',
        'name' => 'OpenAI main',
        'api_key' => 'sk-openai-abcdefghijklmnopqrstuvwxyz',
        'is_default' => true,
        'is_active' => true,
    ]);

    PostTranslationAgent::fake(function (string $prompt): array {
        $locale = str_contains($prompt, 'locale "vi"') ? 'vi' : 'zh';

        return [
            'title' => "Translated {$locale} title",
            'excerpt' => "Translated {$locale} excerpt",
            'content' => "<p>Translated {$locale} content</p>",
            'meta_title' => "Translated {$locale} meta title",
            'meta_description' => "Translated {$locale} meta description",
        ];
    });

    $this->actingAs($user)
        ->post(route('admin.posts.store'), [
            'category_id' => $category->id,
            'locale' => 'en',
            'title' => 'English source title',
            'slug' => 'english-source-title',
            'excerpt' => 'English excerpt',
            'content' => '<p>English content</p>',
            'status' => 'draft',
            'meta_title' => 'English meta title',
            'meta_description' => 'English meta description',
        ])
        ->assertRedirect();

    $source = Post::query()->where('locale', 'en')->where('slug', 'english-source-title')->first();
    expect($source)->not->toBeNull();

    $siblings = Post::query()
        ->where('translation_group_id', $source->translation_group_id)
        ->orderBy('locale')
        ->pluck('locale')
        ->all();

    expect($siblings)->toBe(['en', 'vi', 'zh']);
    expect(Post::query()->where('translation_group_id', $source->translation_group_id)->where('locale', 'vi')->value('title'))
        ->toBe('Translated vi title');
    expect(Post::query()->where('translation_group_id', $source->translation_group_id)->where('locale', 'zh')->value('title'))
        ->toBe('Translated zh title');
});
