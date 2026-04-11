<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

test('database seeder creates the admin account', function () {
    $this->seed(DatabaseSeeder::class);

    $user = User::query()->where('email', 'admin@mlgroup.vn')->first();

    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('Minh Long Admin')
        ->and(Hash::check('123456a@', $user->password))->toBeTrue()
        ->and($user->email_verified_at)->not->toBeNull();
});
