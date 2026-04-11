<?php

namespace Database\Seeders;

use App\Models\LibraryDocument;
use Illuminate\Database\Seeder;

/**
 * Seeds public profile documents for the home “Download profile” modal and /thu-vien (S-018).
 *
 * PDFs are linked via Google Drive (no large files in the repo or app storage).
 *
 * ```bash
 * php artisan db:seed --class=Database\\Seeders\\LibraryProfileDocumentsSeeder --force
 * ```
 *
 * Idempotent: matches rows by `library_category` + `sort_order`, updates title and URL,
 * and clears any previously attached Spatie `file` media. `link_type` is **external**; public pages link straight to the URL.
 */
class LibraryProfileDocumentsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'sort_order' => 10,
                'title' => 'MINH LONG CONSTRUCTION 2026',
                'external_url' => 'https://drive.google.com/file/d/1i6AogKW7BxrBrmzfF4vZ9tFyN0B6FRG5/view?usp=drive_link',
            ],
            [
                'sort_order' => 20,
                'title' => 'MINH LONG GROUP 2026',
                'external_url' => 'https://drive.google.com/file/d/15EZEFhFdqU0yh8aD55I7YYnOppQh8K2B/view?usp=drive_link',
            ],
            [
                'sort_order' => 30,
                'title' => 'MINH LONG POWER 2026',
                'external_url' => 'https://drive.google.com/file/d/1tX6-zGa1TELCJ4Blu36WEsG0IZsU-Mid/view?usp=drive_link',
            ],
        ];

        foreach ($items as $item) {
            $document = LibraryDocument::query()->updateOrCreate(
                [
                    'library_category' => LibraryDocument::CATEGORY_PROFILE,
                    'sort_order' => $item['sort_order'],
                ],
                [
                    'title' => $item['title'],
                    'external_url' => $item['external_url'],
                    'link_type' => LibraryDocument::LINK_EXTERNAL,
                    'is_public' => true,
                ],
            );

            $document->clearMediaCollection('file');
        }
    }
}
