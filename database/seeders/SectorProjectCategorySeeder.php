<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class SectorProjectCategorySeeder extends Seeder
{
    /**
     * Seed project categories aligned with business sectors (B-011).
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Constructor', 'slug' => 'constructor', 'sector_key' => 'constructor', 'sort_order' => 10, 'description' => 'Construction & EPC projects.', 'status' => 'active'],
            ['name' => 'Minh Long Land', 'slug' => 'land', 'sector_key' => 'land', 'sort_order' => 20, 'description' => 'Land and industrial real estate projects.', 'status' => 'active'],
            ['name' => 'Minh Long Host', 'slug' => 'host', 'sector_key' => 'host', 'sort_order' => 30, 'description' => 'Host & operations projects.', 'status' => 'active'],
            ['name' => 'Minh Long Power', 'slug' => 'power', 'sector_key' => 'power', 'sort_order' => 40, 'description' => 'Power & energy projects.', 'status' => 'active'],
            ['name' => 'Minh Long Minerals', 'slug' => 'minerals', 'sector_key' => 'minerals', 'sort_order' => 50, 'description' => 'Mining & materials projects.', 'status' => 'active'],
            ['name' => 'General', 'slug' => 'general-news', 'sector_key' => 'general_news', 'sort_order' => 60, 'description' => 'Other highlighted work.', 'status' => 'active'],
        ];

        foreach ($rows as $row) {
            ProjectCategory::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }
    }
}
