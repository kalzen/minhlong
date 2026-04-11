<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteMediaPlacementRequest;
use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use App\Support\SiteMedia;
use Illuminate\Http\RedirectResponse;
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
            'preview_url' => SiteMedia::urlOrDefault($p->position_key),
            'upload_url' => $p->getFirstMediaUrl('image') ?: null,
            'stored_image_url' => SiteMediaLink::query()
                ->where('position_key', $p->position_key)
                ->value('url'),
        ]);

        return Inertia::render('admin/SiteMedia/Index', [
            'placements' => $placements,
        ]);
    }

    public function update(UpdateSiteMediaPlacementRequest $request, SiteMediaPlacement $siteMediaPlacement): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $siteMediaPlacement->clearMediaCollection('image');
            $siteMediaPlacement->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if ($request->exists('image_url')) {
            $raw = $request->validated('image_url');
            if ($raw === null || trim((string) $raw) === '') {
                SiteMediaLink::query()
                    ->where('position_key', $siteMediaPlacement->position_key)
                    ->delete();
            } else {
                SiteMediaLink::query()->updateOrCreate(
                    ['position_key' => $siteMediaPlacement->position_key],
                    [
                        'label' => $siteMediaPlacement->label,
                        'url' => trim((string) $raw),
                    ]
                );
            }
        }

        return redirect()->route('admin.site-media.index')->with('success', 'Site image updated.');
    }
}
