<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLibraryDocumentRequest;
use App\Http\Requests\Admin\UpdateLibraryDocumentRequest;
use App\Models\LibraryDocument;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LibraryDocumentController extends Controller
{
    public function index(): Response
    {
        $documents = LibraryDocument::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get()
            ->map(fn (LibraryDocument $doc) => [
                'id' => $doc->id,
                'title' => $doc->title,
                'library_category' => $doc->library_category,
                'is_public' => $doc->is_public,
                'sort_order' => $doc->sort_order,
                'file_name' => $doc->getFirstMedia('file')?->file_name,
            ]);

        return Inertia::render('admin/LibraryDocuments/Index', [
            'documents' => $documents,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/LibraryDocuments/Edit', [
            'document' => null,
        ]);
    }

    public function store(StoreLibraryDocumentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $doc = LibraryDocument::query()->create([
            'title' => $data['title'],
            'library_category' => $data['library_category'],
            'is_public' => $request->boolean('is_public', true),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        $doc->addMediaFromRequest('file')->toMediaCollection('file');

        return redirect()->route('admin.library-documents.index')->with('success', __('Document uploaded.'));
    }

    public function edit(LibraryDocument $libraryDocument): Response
    {
        return Inertia::render('admin/LibraryDocuments/Edit', [
            'document' => [
                'id' => $libraryDocument->id,
                'title' => $libraryDocument->title,
                'library_category' => $libraryDocument->library_category,
                'is_public' => $libraryDocument->is_public,
                'sort_order' => $libraryDocument->sort_order,
                'file_name' => $libraryDocument->getFirstMedia('file')?->file_name,
            ],
        ]);
    }

    public function update(UpdateLibraryDocumentRequest $request, LibraryDocument $libraryDocument): RedirectResponse
    {
        $data = $request->validated();

        $libraryDocument->update([
            'title' => $data['title'],
            'library_category' => $data['library_category'],
            'is_public' => $request->has('is_public') ? $request->boolean('is_public') : $libraryDocument->is_public,
            'sort_order' => $data['sort_order'] ?? $libraryDocument->sort_order,
        ]);

        if ($request->hasFile('file')) {
            $libraryDocument->clearMediaCollection('file');
            $libraryDocument->addMediaFromRequest('file')->toMediaCollection('file');
        }

        return redirect()->route('admin.library-documents.index')->with('success', __('Document updated.'));
    }

    public function destroy(LibraryDocument $libraryDocument): RedirectResponse
    {
        $libraryDocument->clearMediaCollection('file');
        $libraryDocument->delete();

        return redirect()->route('admin.library-documents.index')->with('success', __('Document deleted.'));
    }
}
