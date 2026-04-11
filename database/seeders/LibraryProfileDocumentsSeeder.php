<?php

namespace Database\Seeders;

use App\Models\LibraryDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Seed riêng các tài liệu profile PDF (thư viện download — S-018 / modal trang chủ).
 *
 * Trên hosting, sau khi upload mã nguồn, đặt 3 file PDF vào **một trong hai** thư mục:
 * - `docs/brochure-extraction/ocr/`
 * - `database/seeders/brochures/` (tiện khi không deploy thư mục `docs/`)
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

        foreach ($items as $item) {
            $source = $this->resolveSourcePath($item['file']);
            if ($source === null) {
                if ($this->command !== null) {
                    $this->command->warn("Bỏ qua (không tìm thấy file): {$item['file']}");
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
        }
    }

    private function resolveSourcePath(string $filename): ?string
    {
        $candidates = [
            base_path('docs/brochure-extraction/ocr/'.$filename),
            base_path('database/seeders/brochures/'.$filename),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}
