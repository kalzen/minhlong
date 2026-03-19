<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Industrial EPC', 'slug' => 'industrial-epc', 'description' => 'EPC execution for industrial facilities and factories.', 'status' => 'active'],
            ['name' => 'M&E Systems', 'slug' => 'me-systems', 'description' => 'Mechanical and electrical systems for industrial projects.', 'status' => 'active'],
            ['name' => 'Safety & Quality', 'slug' => 'safety-quality', 'description' => 'Quality assurance, safety standards, and compliance.', 'status' => 'active'],
        ];

        foreach ($categories as $cat) {
            PostCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
