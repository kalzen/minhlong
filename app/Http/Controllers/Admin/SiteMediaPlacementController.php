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
    /**
     * @var array<string, array{order: int, title: string}>
     */
    private const SECTION_META = [
        'brand' => ['order' => 0, 'title' => 'Brand & global'],
        'home' => ['order' => 10, 'title' => 'Trang chủ'],
        'sectors' => ['order' => 20, 'title' => 'Trang ngành (Land, Host, Power, Minerals)'],
        'seo' => ['order' => 30, 'title' => 'SEO & chia sẻ'],
        'other' => ['order' => 90, 'title' => 'Khác'],
    ];

    public function index(): Response
    {
        $placements = SiteMediaPlacement::query()->orderBy('position_key')->get()->map(function (SiteMediaPlacement $p) {
            $section = $this->sectionForPositionKey($p->position_key);
            $meta = self::SECTION_META[$section] ?? self::SECTION_META['other'];

            return [
                'id' => $p->id,
                'position_key' => $p->position_key,
                'label' => $p->label,
                'section' => $section,
                'section_order' => $meta['order'],
                'section_title' => $meta['title'],
                'preview_url' => SiteMedia::urlOrDefault($p->position_key),
                'upload_url' => $p->getFirstMediaUrl('image') ?: null,
                'stored_image_url' => SiteMediaLink::query()
                    ->where('position_key', $p->position_key)
                    ->value('url'),
            ];
        });

        return Inertia::render('admin/SiteMedia/Index', [
            'placements' => $placements,
        ]);
    }

    private function sectionForPositionKey(string $positionKey): string
    {
        return match (true) {
            str_starts_with($positionKey, 'brand.') => 'brand',
            str_starts_with($positionKey, 'hero.home.') || str_starts_with($positionKey, 'home.') => 'home',
            str_starts_with($positionKey, 'sector.') => 'sectors',
            str_starts_with($positionKey, 'og.') => 'seo',
            default => 'other',
        };
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
