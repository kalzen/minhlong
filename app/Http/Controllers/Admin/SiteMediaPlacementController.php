<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteMediaPlacement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteMediaPlacementController extends Controller
{
    public function index(): Response
    {
        $placements = SiteMediaPlacement::query()->orderBy('position_key')->get()->map(fn (SiteMediaPlacement $p) => [
            'id' => $p->id,
            'position_key' => $p->position_key,
            'label' => $p->label,
            'url' => $p->getFirstMediaUrl('image') ?: null,
        ]);

        return Inertia::render('admin/SiteMedia/Index', [
            'placements' => $placements,
        ]);
    }

    public function update(Request $request, SiteMediaPlacement $siteMediaPlacement): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'file', 'image', 'max:10240'],
        ]);

        $siteMediaPlacement->clearMediaCollection('image');
        $siteMediaPlacement->addMediaFromRequest('image')->toMediaCollection('image');

        return redirect()->route('admin.site-media.index')->with('success', 'Image updated.');
    }
}
