<?php

namespace App\Http\Requests\Admin;

use App\Models\LibraryDocument;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLibraryDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('external_url') === '') {
            $this->merge(['external_url' => null]);
        }
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'library_category' => ['required', 'string', Rule::in([LibraryDocument::CATEGORY_PROFILE, LibraryDocument::CATEGORY_REPORT])],
            'link_type' => ['required', 'string', Rule::in([LibraryDocument::LINK_INTERNAL, LibraryDocument::LINK_EXTERNAL])],
            'is_public' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0', 'max:65535'],
            'external_url' => [
                Rule::requiredIf(fn () => (string) $this->input('link_type') === LibraryDocument::LINK_EXTERNAL),
                'exclude_if:link_type,'.LibraryDocument::LINK_INTERNAL,
                'nullable',
                'string',
                'url',
                'max:2048',
            ],
            'file' => [
                Rule::requiredIf(fn () => (string) $this->input('link_type') === LibraryDocument::LINK_INTERNAL),
                'exclude_if:link_type,'.LibraryDocument::LINK_EXTERNAL,
                'nullable',
                'file',
                'max:51200',
                'mimetypes:text/csv,text/plain,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'link_type.required' => __('Choose internal (upload) or external (URL).'),
            'link_type.in' => __('Link type must be internal or external.'),
            'file.required_if' => __('A file is required for internal documents.'),
            'external_url.required_if' => __('An external URL is required for external documents.'),
            'file.mimetypes' => __('Only PDF, Word, Excel, CSV, or plain text files are allowed.'),
            'library_category.in' => __('Category must be profile or report.'),
        ];
    }
}
