<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SyncsFeaturedFromEditorLibrary;
use App\Http\Controllers\Controller;
use App\Models\EditorMediaItem;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    use SyncsFeaturedFromEditorLibrary;

    public function index(Request $request): Response
    {
        $projects = Project::query()
            ->with('category')
            ->when($request->string('locale')->toString(), fn ($q, $locale) => $q->where('locale', $locale))
            ->orderByRaw('CASE WHEN translation_group_id IS NULL THEN 1 ELSE 0 END')
            ->orderBy('translation_group_id')
            ->orderBy('locale')
            ->orderByDesc('updated_at')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('admin/Projects/Index', [
            'projects' => $projects,
            'filters' => [
                'locale' => $request->string('locale')->toString() ?: null,
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Projects/Edit', [
            'project' => null,
            'categories' => ProjectCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, null);
        if (empty($data['translation_group_id'])) {
            $data['translation_group_id'] = (string) Str::uuid();
        }
        $project = Project::query()->create($data + ['created_by' => $request->user()?->id]);

        $this->syncFeaturedFromEditorLibrary($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Project created.');
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('admin/Projects/Edit', [
            'project' => [
                'id' => $project->id,
                'category_id' => $project->category_id,
                'translation_group_id' => $project->translation_group_id,
                'locale' => $project->locale,
                'title' => $project->title,
                'slug' => $project->slug,
                'excerpt' => $project->excerpt,
                'content' => $project->content,
                'status' => $project->status,
                'published_at' => $project->published_at?->format('Y-m-d\TH:i'),
                'meta_title' => $project->meta_title,
                'meta_description' => $project->meta_description,
                'featured_url' => $project->getFirstMediaUrl('featured') ?: null,
            ],
            'categories' => ProjectCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validated($request, $project);
        $project->update($data);

        $this->syncFeaturedFromEditorLibrary($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Project $project): array
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:project_categories,id'],
            'translation_group_id' => ['nullable', 'uuid'],
            'locale' => ['required', 'string', 'max:8'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('projects', 'slug')
                    ->where(fn ($query) => $query->where('locale', $request->input('locale')))
                    ->ignore($project?->id),
            ],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'featured' => ['nullable', 'file', 'image', 'max:10240'],
            'featured_library_media_id' => [
                'nullable',
                'integer',
                Rule::exists('media', 'id')->where(
                    fn ($q) => $q->where('model_type', EditorMediaItem::class)->where('collection_name', 'image')
                ),
            ],
        ]);

        unset($validated['featured'], $validated['featured_library_media_id']);

        if (($validated['translation_group_id'] ?? '') === '') {
            $validated['translation_group_id'] = null;
        }

        return $validated;
    }
}
