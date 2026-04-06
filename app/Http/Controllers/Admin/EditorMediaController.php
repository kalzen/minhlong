<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorMediaFolder;
use App\Models\EditorMediaItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EditorMediaController extends Controller
{
    /**
     * List folders + images for the current folder (WordPress-style library).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->integer('per_page', 24), 1), 60);
        $folderId = $request->filled('folder_id') ? $request->integer('folder_id') : null;

        if ($folderId !== null) {
            EditorMediaFolder::query()->findOrFail($folderId);
        }

        $folders = EditorMediaFolder::query()
            ->where('parent_id', $folderId)
            ->orderBy('name')
            ->get(['id', 'name', 'parent_id'])
            ->map(fn (EditorMediaFolder $f) => [
                'id' => $f->id,
                'name' => $f->name,
                'parent_id' => $f->parent_id,
            ])
            ->values();

        $itemIds = EditorMediaItem::query()
            ->when($folderId === null, fn ($q) => $q->whereNull('editor_media_folder_id'))
            ->when($folderId !== null, fn ($q) => $q->where('editor_media_folder_id', $folderId))
            ->pluck('id');

        $paginator = Media::query()
            ->where('model_type', EditorMediaItem::class)
            ->where('collection_name', 'image')
            ->whereIn('model_id', $itemIds)
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json([
            'current_folder_id' => $folderId,
            'breadcrumbs' => $this->breadcrumbPayload($folderId),
            'folders' => $folders,
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
            'folder_id' => ['nullable', 'exists:editor_media_folders,id'],
        ]);

        $folderId = $request->filled('folder_id') ? $request->integer('folder_id') : null;

        $item = EditorMediaItem::query()->create([
            'user_id' => $request->user()?->id,
            'editor_media_folder_id' => $folderId,
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

    /**
     * Create a new folder under the current parent (optional).
     */
    public function storeFolder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:editor_media_folders,id'],
        ]);

        $parentId = $validated['parent_id'] ?? null;

        $exists = EditorMediaFolder::query()
            ->where('parent_id', $parentId)
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Đã có thư mục cùng tên ở vị trí này.'], 422);
        }

        $folder = EditorMediaFolder::query()->create([
            'name' => $validated['name'],
            'parent_id' => $parentId,
            'user_id' => $request->user()?->id,
        ]);

        return response()->json([
            'id' => $folder->id,
            'name' => $folder->name,
            'parent_id' => $folder->parent_id,
        ]);
    }

    /**
     * @return list<array{id: int, name: string}>
     */
    private function breadcrumbPayload(?int $folderId): array
    {
        if ($folderId === null) {
            return [];
        }

        $chain = [];
        $current = EditorMediaFolder::query()->find($folderId);

        while ($current !== null) {
            array_unshift($chain, [
                'id' => $current->id,
                'name' => $current->name,
            ]);
            $current = $current->parent_id !== null
                ? EditorMediaFolder::query()->find($current->parent_id)
                : null;
        }

        return $chain;
    }
}
