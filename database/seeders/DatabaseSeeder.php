<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@mlgroup.vn'],
            [
                'name' => 'Minh Long Admin',
                'password' => Hash::make('123456a@'),
                'email_verified_at' => now(),
            ],
        );

        $this->call([
            SiteSettingsSeeder::class,
            SectorPostCategorySeeder::class,
            SectorProjectCategorySeeder::class,
            SiteMediaPlacementSeeder::class,
            SiteMediaLinkSeeder::class,
            PostSeeder::class,
        ]);
    }
}
