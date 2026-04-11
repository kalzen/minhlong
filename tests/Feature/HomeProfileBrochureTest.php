<?php

use App\Models\LibraryDocument;
use Database\Seeders\LibraryProfileDocumentsSeeder;

test('home page shows profile download button modal and seeded profile links', function () {
    $this->seed(LibraryProfileDocumentsSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('id="profileDownloadModal"', false);
    $response->assertSee('Download profile', false);
    $response->assertSee('MINH LONG CONSTRUCTION 2026', false);
    $response->assertSee('MINH LONG GROUP 2026', false);
    $response->assertSee('MINH LONG POWER 2026', false);

    $body = $response->getContent();
    expect(substr_count($body, 'drive.google.com/file/d/'))->toBe(3);
});

test('library download route redirects to external url when document has no uploaded file', function () {
    $this->seed(LibraryProfileDocumentsSeeder::class);

    $doc = LibraryDocument::query()
        ->where('library_category', LibraryDocument::CATEGORY_PROFILE)
        ->where('title', 'MINH LONG GROUP 2026')
        ->firstOrFail();

    $this->get(route('site.library.download', $doc))
        ->assertRedirect($doc->external_url);
});
