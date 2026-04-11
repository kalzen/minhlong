<?php

use App\Models\LibraryDocument;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('guests cannot access admin library documents', function () {
    $this->get(route('admin.library-documents.index'))->assertRedirect(route('login'));
});

test('authenticated users can view library documents index', function () {
    $this->actingAs(User::factory()->create());
    $this->withoutVite();

    $this->get(route('admin.library-documents.index'))->assertOk();
});

test('authenticated user can create a library document with an external url only', function () {
    $this->actingAs(User::factory()->create());

    $url = 'https://drive.google.com/file/d/15EZEFhFdqU0yh8aD55I7YYnOppQh8K2B/view?usp=drive_link';

    $response = $this->post(route('admin.library-documents.store'), [
        'title' => 'Profile via Drive',
        'library_category' => LibraryDocument::CATEGORY_PROFILE,
        'link_type' => LibraryDocument::LINK_EXTERNAL,
        'is_public' => 1,
        'sort_order' => 2,
        'external_url' => $url,
    ]);

    $response->assertRedirect(route('admin.library-documents.index'));
    $this->assertDatabaseHas('library_documents', [
        'title' => 'Profile via Drive',
        'library_category' => LibraryDocument::CATEGORY_PROFILE,
        'link_type' => LibraryDocument::LINK_EXTERNAL,
        'is_public' => true,
        'sort_order' => 2,
        'external_url' => $url,
    ]);
});

test('store rejects create when link type is missing', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->post(route('admin.library-documents.store'), [
        'title' => 'Incomplete',
        'library_category' => LibraryDocument::CATEGORY_REPORT,
        'is_public' => 1,
        'sort_order' => 0,
    ]);

    $response->assertSessionHasErrors('link_type');
    $this->assertDatabaseMissing('library_documents', ['title' => 'Incomplete']);
});

test('authenticated user can create a library document with a pdf', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->createWithContent(
        'company-profile.pdf',
        "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n",
    );

    $response = $this->post(route('admin.library-documents.store'), [
        'title' => 'Company profile 2026',
        'library_category' => LibraryDocument::CATEGORY_PROFILE,
        'link_type' => LibraryDocument::LINK_INTERNAL,
        'is_public' => 1,
        'sort_order' => 5,
        'file' => $file,
    ]);

    $response->assertRedirect(route('admin.library-documents.index'));
    $this->assertDatabaseHas('library_documents', [
        'title' => 'Company profile 2026',
        'library_category' => LibraryDocument::CATEGORY_PROFILE,
        'link_type' => LibraryDocument::LINK_INTERNAL,
        'is_public' => true,
        'sort_order' => 5,
    ]);
});

test('store rejects disallowed mime types', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->create('malware.exe', 50, 'application/x-msdownload');

    $response = $this->post(route('admin.library-documents.store'), [
        'title' => 'Bad',
        'library_category' => LibraryDocument::CATEGORY_REPORT,
        'link_type' => LibraryDocument::LINK_INTERNAL,
        'is_public' => 1,
        'sort_order' => 0,
        'file' => $file,
    ]);

    $response->assertSessionHasErrors('file');
    $this->assertDatabaseMissing('library_documents', ['title' => 'Bad']);
});

test('authenticated user can update and delete a library document', function () {
    $this->actingAs(User::factory()->create());

    $doc = LibraryDocument::query()->create([
        'title' => 'Original title',
        'library_category' => LibraryDocument::CATEGORY_PROFILE,
        'link_type' => LibraryDocument::LINK_INTERNAL,
        'is_public' => true,
        'sort_order' => 1,
    ]);
    $doc->addMedia(
        UploadedFile::fake()->createWithContent('a.pdf', "%PDF-1.4\n%%EOF\n")
    )->toMediaCollection('file');

    $update = $this->from(route('admin.library-documents.edit', $doc))->put(
        route('admin.library-documents.update', $doc),
        [
            'title' => 'Updated title',
            'library_category' => LibraryDocument::CATEGORY_REPORT,
            'link_type' => LibraryDocument::LINK_INTERNAL,
            'is_public' => 0,
            'sort_order' => 9,
        ]
    );

    $update->assertRedirect(route('admin.library-documents.index'));
    $doc->refresh();
    expect($doc->title)->toBe('Updated title')
        ->and($doc->library_category)->toBe(LibraryDocument::CATEGORY_REPORT)
        ->and($doc->is_public)->toBeFalse()
        ->and($doc->sort_order)->toBe(9);

    $this->delete(route('admin.library-documents.destroy', $doc))
        ->assertRedirect(route('admin.library-documents.index'));

    $this->assertDatabaseMissing('library_documents', ['id' => $doc->id]);
});
