<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreAIMarketingPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Always return JSON validation errors for this API, even if the client
        // omits Accept: application/json (otherwise tools only show "422 Unprocessable Content").
        $this->headers->set('Accept', 'application/json');

        $html = $this->input('content');
        if (! is_string($html) || trim($html) === '') {
            $html = $this->input('body');
        }
        $html = is_string($html) ? trim($html) : '';

        $faq = $this->input('faq');
        if (is_array($faq) && $faq !== []) {
            $html .= $this->faqToAppendHtml($faq);
        }

        if ($html !== '') {
            $this->merge(['content' => $html]);
        }

        $description = $this->input('description');
        if (is_string($description) && $description !== '') {
            if (! $this->filled('excerpt')) {
                $this->merge(['excerpt' => $description]);
            }
            if (! $this->filled('meta_description')) {
                $this->merge(['meta_description' => Str::limit($description, 255, '')]);
            }
        }
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first() ?: 'The given data was invalid.',
            'errors' => $validator->errors()->toArray(),
        ], 422));
    }

    /**
     * @param  array<int, mixed>  $faq
     */
    private function faqToAppendHtml(array $faq): string
    {
        $blocks = [];
        foreach ($faq as $item) {
            if (! is_array($item)) {
                continue;
            }
            $question = $item['question'] ?? null;
            $answer = $item['answer'] ?? null;
            if (! is_string($question) || trim($question) === '' || ! is_string($answer) || trim($answer) === '') {
                continue;
            }
            $blocks[] = '<div class="faq-item"><h3>'.e($question).'</h3><div class="faq-answer">'.nl2br(e($answer)).'</div></div>';
        }

        if ($blocks === []) {
            return '';
        }

        return '<section class="post-faq"><h2>FAQ</h2>'.implode('', $blocks).'</section>';
    }

    /**
     * @return array<string, array<int, string|ValidationRule>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'faq' => ['nullable', 'array', 'max:100'],
            'faq.*.question' => ['nullable', 'string', 'max:2000'],
            'faq.*.answer' => ['nullable', 'string', 'max:50000'],
            'image_urls' => ['nullable', 'array', 'max:50'],
            'image_urls.*' => ['nullable', 'string', 'max:2048'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string', 'min:1'],
            'thumbnail_path' => ['nullable', 'string', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(['draft', 'published'])],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:post_categories,id'],
        ];
    }
}
