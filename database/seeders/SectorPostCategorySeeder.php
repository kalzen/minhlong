<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class SectorPostCategorySeeder extends Seeder
{
    /**
     * Seed post categories aligned with business sectors (B-011).
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Constructor', 'slug' => 'constructor', 'sector_key' => 'constructor', 'sort_order' => 10, 'description' => 'Construction & EPC.', 'status' => 'active'],
            ['name' => 'Minh Long Land', 'slug' => 'land', 'sector_key' => 'land', 'sort_order' => 20, 'description' => 'Land and industrial real estate.', 'status' => 'active'],
            ['name' => 'Minh Long Host', 'slug' => 'host', 'sector_key' => 'host', 'sort_order' => 30, 'description' => 'Group governance & project operations.', 'status' => 'active'],
            ['name' => 'Minh Long Power', 'slug' => 'power', 'sector_key' => 'power', 'sort_order' => 40, 'description' => 'Power & electrical infrastructure.', 'status' => 'active'],
            ['name' => 'Minh Long Minerals', 'slug' => 'minerals', 'sector_key' => 'minerals', 'sort_order' => 50, 'description' => 'Mining & materials.', 'status' => 'active'],
            ['name' => 'General news', 'slug' => 'general-news', 'sector_key' => 'general_news', 'sort_order' => 60, 'description' => 'Group news and updates.', 'status' => 'active'],
        ];

        foreach ($rows as $row) {
            PostCategory::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }
    }
}
