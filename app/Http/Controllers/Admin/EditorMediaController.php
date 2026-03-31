<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorMediaController extends Controller
{
    /**
     * Upload an image for rich-text editors (TipTap); returns public URL.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required', 'file', 'image', 'max:8192'],
        ]);

        $path = $request->file('upload')->store('editor', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }
}
