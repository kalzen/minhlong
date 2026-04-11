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

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'library_category' => ['required', 'string', Rule::in([LibraryDocument::CATEGORY_PROFILE, LibraryDocument::CATEGORY_REPORT])],
            'is_public' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0', 'max:65535'],
            'file' => ['required', 'file', 'max:51200', 'mimetypes:text/csv,text/plain,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'file.required' => __('A file is required to create a library document.'),
            'file.mimetypes' => __('Only PDF, Word, Excel, CSV, or plain text files are allowed.'),
            'library_category.in' => __('Category must be profile or report.'),
        ];
    }
}
