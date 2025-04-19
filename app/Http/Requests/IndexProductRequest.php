<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sort' => 'required|in:ASC,DESC',
            'category' => 'nullable|exists:categories,id',
            'page' => 'numeric',
            'perPage' => 'numeric',
        ];
    }

        /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->mergeIfMissing([
            'sort' => 'ASC',
            'page' => 1,
            'perPage' => 5
        ]);
    }
}
