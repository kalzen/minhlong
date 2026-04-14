<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpsertUserAiApiKeyRequest;
use App\Models\UserAiApiKey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AiApiKeyController extends Controller
{
    public function edit(Request $request): Response
    {
        $keys = UserAiApiKey::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('provider')
            ->orderByDesc('is_default')
            ->orderBy('name')
            ->get()
            ->map(fn (UserAiApiKey $key) => [
                'id' => $key->id,
                'provider' => $key->provider,
                'model' => $key->model,
                'name' => $key->name,
                'is_default' => $key->is_default,
                'is_active' => $key->is_active,
                'masked_key' => $this->maskKey($key->api_key),
            ]);

        return Inertia::render('settings/AiKeys', [
            'keys' => $keys,
            'providers' => [
                ['value' => 'openai', 'label' => 'OpenAI'],
                ['value' => 'anthropic', 'label' => 'Anthropic'],
                ['value' => 'gemini', 'label' => 'Google Gemini'],
                ['value' => 'xai', 'label' => 'xAI'],
                ['value' => 'deepseek', 'label' => 'DeepSeek'],
                ['value' => 'groq', 'label' => 'Groq'],
                ['value' => 'mistral', 'label' => 'Mistral'],
            ],
        ]);
    }

    public function store(UpsertUserAiApiKeyRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $userId = $request->user()->id;

        if (($data['is_default'] ?? false) === true) {
            UserAiApiKey::query()
                ->where('user_id', $userId)
                ->where('provider', $data['provider'])
                ->update(['is_default' => false]);
        }

        UserAiApiKey::query()->create([
            'user_id' => $userId,
            'provider' => $data['provider'],
            'model' => $data['model'] ?? null,
            'name' => $data['name'],
            'api_key' => $data['api_key'],
            'is_default' => (bool) ($data['is_default'] ?? false),
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        return to_route('settings.ai-keys.edit');
    }

    public function update(UpsertUserAiApiKeyRequest $request, UserAiApiKey $userAiApiKey): RedirectResponse
    {
        $this->authorizeOwnership($request, $userAiApiKey);
        $data = $request->validated();

        if (($data['is_default'] ?? false) === true) {
            UserAiApiKey::query()
                ->where('user_id', $request->user()->id)
                ->where('provider', $data['provider'])
                ->where('id', '!=', $userAiApiKey->id)
                ->update(['is_default' => false]);
        }

        $userAiApiKey->update([
            'provider' => $data['provider'],
            'model' => $data['model'] ?? $userAiApiKey->model,
            'name' => $data['name'],
            'api_key' => ($data['api_key'] ?? '') !== '' ? $data['api_key'] : $userAiApiKey->api_key,
            'is_default' => (bool) ($data['is_default'] ?? $userAiApiKey->is_default),
            'is_active' => (bool) ($data['is_active'] ?? $userAiApiKey->is_active),
        ]);

        return to_route('settings.ai-keys.edit');
    }

    public function destroy(Request $request, UserAiApiKey $userAiApiKey): RedirectResponse
    {
        $this->authorizeOwnership($request, $userAiApiKey);
        $userAiApiKey->delete();

        return to_route('settings.ai-keys.edit');
    }

    private function authorizeOwnership(Request $request, UserAiApiKey $userAiApiKey): void
    {
        abort_unless($userAiApiKey->user_id === $request->user()->id, 403);
    }

    private function maskKey(string $apiKey): string
    {
        $prefix = substr($apiKey, 0, 5);
        $suffix = substr($apiKey, -4);

        return $prefix.'...'.$suffix;
    }
}
