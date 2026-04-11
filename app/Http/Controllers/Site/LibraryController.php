<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\LibraryDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LibraryController extends Controller
{
    public function index(): View
    {
        $documents = LibraryDocument::query()
            ->where('is_public', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get()
            ->filter(fn (LibraryDocument $doc) => $doc->hasDownloadTarget());

        return view('site.library.index', [
            'title' => __('site.library.page_title'),
            'metaDescription' => __('site.library.meta_description'),
            'documents' => $documents,
        ]);
    }

    public function download(LibraryDocument $libraryDocument): BinaryFileResponse|RedirectResponse|Response
    {
        if (! $libraryDocument->is_public) {
            abort(404);
        }

        if ($libraryDocument->isExternalLink()) {
            if (filled($libraryDocument->external_url)) {
                return redirect()->away($libraryDocument->external_url);
            }

            abort(404);
        }

        $media = $libraryDocument->getFirstMedia('file');
        if ($media === null) {
            abort(404);
        }

        return response()->download($media->getPath(), $media->file_name);
    }
}
