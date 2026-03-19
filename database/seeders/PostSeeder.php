<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = PostCategory::all()->keyBy('slug');
        $userId = User::query()->first()?->id;

        $posts = [
            [
                'title' => 'How to plan an industrial-zone factory project for faster delivery',
                'slug' => 'plan-industrial-zone-factory-project-faster-delivery',
                'excerpt' => 'A practical framework to align scope, timeline, and utility requirements before construction starts.',
                'content' => '<p>Factory projects in industrial zones move faster when design, utility interfaces, and construction sequencing are planned together. Early coordination between civil, steel, and M&amp;E teams reduces rework and protects schedule commitments.</p><p>At Minh Long, we prioritize integrated planning and milestone control from day one so investors can bring facilities into operation with confidence.</p>',
                'thumbnail_path' => 'frontend/images/post-1.jpg',
                'category_slug' => 'industrial-epc',
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => 'M&E coordination strategies that reduce rework on factory sites',
                'slug' => 'me-coordination-strategies-reduce-rework-factory-sites',
                'excerpt' => 'Key M&E coordination practices to improve installation quality and avoid late-stage clashes.',
                'content' => '<p>Effective M&amp;E coordination is critical for industrial buildings with dense technical systems. Clear shop drawings, interface management, and phased inspections help keep installation quality consistent.</p><p>By integrating M&amp;E planning with construction activities, project teams can minimize delays and control total execution cost.</p>',
                'thumbnail_path' => 'frontend/images/post-2.jpg',
                'category_slug' => 'me-systems',
                'published_at' => now()->subDays(45),
            ],
            [
                'title' => 'QA/QC checklist for steel structure and fire protection packages',
                'slug' => 'qa-qc-checklist-steel-structure-fire-protection-packages',
                'excerpt' => 'A field-oriented QA/QC checklist to ensure compliance, safety, and durable system performance.',
                'content' => '<p>For factory construction, QA/QC must cover incoming materials, welding standards, coating systems, and fire protection testing. Strong documentation and hold-point inspection improve compliance outcomes.</p><p>Applying structured QA/QC processes helps owners reduce risk and maintain reliable plant operations after handover.</p>',
                'thumbnail_path' => 'frontend/images/post-3.jpg',
                'category_slug' => 'safety-quality',
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($posts as $data) {
            $categorySlug = $data['category_slug'];
            unset($data['category_slug']);
            $data['category_id'] = $categories->get($categorySlug)?->id;
            $data['status'] = 'published';
            $data['created_by'] = $userId;
            $data['meta_title'] = $data['title'];
            $data['meta_description'] = $data['excerpt'];

            Post::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
