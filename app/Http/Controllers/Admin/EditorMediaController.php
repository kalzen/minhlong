<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorMediaItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EditorMediaController extends Controller
{
    /**
     * List images uploaded for the rich-text editor (Spatie media).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->integer('per_page', 24), 1), 60);

        $paginator = Media::query()
            ->where('model_type', EditorMediaItem::class)
            ->where('collection_name', 'image')
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json([
            'data' => collect($paginator->items())->map(fn (Media $media) => [
                'id' => $media->id,
                'url' => $media->getFullUrl(),
                'thumb_url' => $media->hasGeneratedConversion('thumb')
                    ? $media->getFullUrl('thumb')
                    : $media->getFullUrl(),
                'name' => $media->name,
                'size' => $media->size,
                'created_at' => $media->created_at?->toIso8601String(),
            ])->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    /**
     * Upload an image for rich-text editors (TipTap); stores via Spatie and returns public URL.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required', 'file', 'image', 'max:8192'],
        ]);

        $item = EditorMediaItem::query()->create([
            'user_id' => $request->user()?->id,
        ]);

        $item->addMediaFromRequest('upload')->toMediaCollection('image');

        $media = $item->getFirstMedia('image');

        if ($media === null) {
            $item->delete();

            return response()->json(['message' => 'Upload failed.'], 422);
        }

        return response()->json([
            'url' => $media->getFullUrl(),
            'thumb_url' => $media->hasGeneratedConversion('thumb')
                ? $media->getFullUrl('thumb')
                : $media->getFullUrl(),
            'id' => $media->id,
        ]);
    }
}
