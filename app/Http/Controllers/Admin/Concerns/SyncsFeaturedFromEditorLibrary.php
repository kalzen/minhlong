<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Models\EditorMediaItem;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait SyncsFeaturedFromEditorLibrary
{
    protected function syncFeaturedFromEditorLibrary(Request $request, HasMedia $model): void
    {
        if ($request->hasFile('featured')) {
            $model->clearMediaCollection('featured');
            $model->addMediaFromRequest('featured')->toMediaCollection('featured');

            return;
        }

        if (! $request->filled('featured_library_media_id')) {
            return;
        }

        $libraryMedia = Media::query()
            ->whereKey($request->integer('featured_library_media_id'))
            ->where('model_type', EditorMediaItem::class)
            ->where('collection_name', 'image')
            ->first();

        if ($libraryMedia === null) {
            return;
        }

        $model->clearMediaCollection('featured');
        $model->addMedia($libraryMedia->getPath())
            ->usingFileName($libraryMedia->file_name)
            ->preservingOriginal()
            ->toMediaCollection('featured');
    }
}
