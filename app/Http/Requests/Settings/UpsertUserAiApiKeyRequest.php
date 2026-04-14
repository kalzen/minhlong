<?php

namespace App\Http\Requests\Settings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpsertUserAiApiKeyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'provider' => ['required', 'string', 'in:openai,anthropic,gemini,xai,deepseek,groq,mistral'],
            'model' => ['nullable', 'string', 'max:120'],
            'name' => ['required', 'string', 'max:80'],
            'api_key' => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:12', 'max:2048'],
            'is_default' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
