<?php

use App\Models\AccessLog;

test('access log stores long user agent without error', function () {
    $longUserAgent = str_repeat('Z', 600);
    $before = AccessLog::query()->count();

    $this->withHeader('User-Agent', $longUserAgent)
        ->get(route('home'))
        ->assertOk();

    expect(AccessLog::query()->count())->toBe($before + 1);

    $latest = AccessLog::query()->orderByDesc('id')->first();
    expect($latest)->not->toBeNull();
    expect(mb_strlen((string) $latest->user_agent))->toBe(600);
    expect($latest->user_agent)->toBe($longUserAgent);
});
