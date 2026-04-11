<?php

namespace Database\Seeders;

use App\Models\LibraryDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProfileBrochureSeeder extends Seeder
{
    /**
     * Copy profile PDFs into public/downloads/profiles and attach to library_documents (Spatie).
     *
     * Source order: docs/brochure-extraction/ocr, then database/seeders/brochures.
     */
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
                    $this->command->warn("Profile brochure skipped (file not found): {$item['file']}");
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
