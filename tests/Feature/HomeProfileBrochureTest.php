<?php

use App\Models\LibraryDocument;
use Database\Seeders\LibraryProfileDocumentsSeeder;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $dir = base_path('docs/brochure-extraction/ocr');
    File::ensureDirectoryExists($dir);
    $stub = "%PDF-1.1\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n";
    foreach (['Minhlong-construction.pdf', 'Minhlong-group.pdf', 'Minhlong-power.pdf'] as $name) {
        File::put($dir.DIRECTORY_SEPARATOR.$name, $stub);
    }
});

afterEach(function () {
    foreach (['Minhlong-construction.pdf', 'Minhlong-group.pdf', 'Minhlong-power.pdf'] as $name) {
        $p = base_path('docs/brochure-extraction/ocr/'.$name);
        if (File::exists($p)) {
            File::delete($p);
        }
        $pub = public_path('downloads/profiles/'.$name);
        if (File::exists($pub)) {
            File::delete($pub);
        }
    }
});

test('home page shows profile download button modal and seeded pdf download links', function () {
    $this->seed(LibraryProfileDocumentsSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('id="profileDownloadModal"', false);
    $response->assertSee('Download profile', false);
    $response->assertSee('Minh Long Construction — Company profile', false);
    $response->assertSee('Minh Long Group — Company profile', false);
    $response->assertSee('Minh Long Power — Company profile', false);

    $body = $response->getContent();
    expect(substr_count($body, 'tai-xuong'))->toBe(3);

    expect(is_file(public_path('downloads/profiles/Minhlong-construction.pdf')))->toBeTrue();
    expect(is_file(public_path('downloads/profiles/Minhlong-group.pdf')))->toBeTrue();
    expect(is_file(public_path('downloads/profiles/Minhlong-power.pdf')))->toBeTrue();
});

test('library download route returns file for profile document', function () {
    $this->seed(LibraryProfileDocumentsSeeder::class);

    $doc = LibraryDocument::query()
        ->where('library_category', LibraryDocument::CATEGORY_PROFILE)
        ->where('title', 'Minh Long Group — Company profile')
        ->firstOrFail();

    $response = $this->get(route('site.library.download', $doc));

    $response->assertOk();
    $response->assertHeader('content-disposition');
});
