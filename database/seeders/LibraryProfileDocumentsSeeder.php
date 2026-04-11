<?php

namespace Database\Seeders;

use App\Models\LibraryDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Seed riêng các tài liệu profile PDF (thư viện download — S-018 / modal trang chủ).
 *
 * Trên hosting, đặt 3 file PDF vào **một trong các** thư mục (theo thứ tự ưu tiên):
 * 1. `storage/app/library-profile-seeds/` — **khuyến nghị** (upload qua FTP/cPanel vào `storage/app/...`)
 * 2. `database/seeders/brochures/`
 * 3. `docs/brochure-extraction/ocr/`
 *
 * Tên file bắt buộc:
 * - Minhlong-construction.pdf
 * - Minhlong-group.pdf
 * - Minhlong-power.pdf
 *
 * Chạy lệnh:
 *
 * ```bash
 * php artisan db:seed --class=Database\\Seeders\\LibraryProfileDocumentsSeeder --force
 * ```
 *
 * Seeder idempotent: `updateOrCreate` theo title + category; copy lại ra `public/downloads/profiles/`
 * và gắn lại media Spatie (collection `file`).
 */
class LibraryProfileDocumentsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'file' => 'Minhlong-construction.pdf',
                'title' => 'Minh Long Construction — Company profile',
                'sort_order' => 10,
            ],
            [
                'file' => 'Minhlong-group.pdf',
                'title' => 'Minh Long Group — Company profile',
                'sort_order' => 20,
            ],
            [
                'file' => 'Minhlong-power.pdf',
                'title' => 'Minh Long Power — Company profile',
                'sort_order' => 30,
            ],
        ];

        $publicDir = public_path('downloads/profiles');
        File::ensureDirectoryExists($publicDir);
        File::ensureDirectoryExists(storage_path('app/library-profile-seeds'));

        $seededCount = 0;

        foreach ($items as $item) {
            $source = $this->resolveSourcePath($item['file']);
            if ($source === null) {
                if ($this->command !== null) {
                    $this->command->warn("Không tìm thấy: {$item['file']}");
                    $this->command->line('  → Upload vào: '.storage_path('app/library-profile-seeds'));
                }

                continue;
            }

            $publicPath = $publicDir.DIRECTORY_SEPARATOR.$item['file'];
            File::copy($source, $publicPath);

            $document = LibraryDocument::query()->updateOrCreate(
                [
                    'library_category' => LibraryDocument::CATEGORY_PROFILE,
                    'title' => $item['title'],
                ],
                [
                    'is_public' => true,
                    'sort_order' => $item['sort_order'],
                ],
            );

            $document->clearMediaCollection('file');
            $document->addMedia($source)
                ->usingFileName($item['file'])
                ->usingName(pathinfo($item['file'], PATHINFO_FILENAME))
                ->toMediaCollection('file');

            $seededCount++;
        }

        if ($seededCount === 0 && $this->command !== null) {
            $this->command->newLine();
            $this->command->error('Chưa seed được PDF nào — thiếu file trên server.');
            $this->command->line('Tạo/thả 3 file vào một trong các thư mục sau rồi chạy lại seeder:');
            $this->command->line('  1. '.storage_path('app/library-profile-seeds').'  (khuyến nghị)');
            $this->command->line('  2. '.base_path('database/seeders/brochures'));
            $this->command->line('  3. '.base_path('docs/brochure-extraction/ocr'));
            $this->command->newLine();
        }
    }

    private function resolveSourcePath(string $filename): ?string
    {
        $candidates = [
            storage_path('app/library-profile-seeds/'.$filename),
            base_path('database/seeders/brochures/'.$filename),
            base_path('docs/brochure-extraction/ocr/'.$filename),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}
