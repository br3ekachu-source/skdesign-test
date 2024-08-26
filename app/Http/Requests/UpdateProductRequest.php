<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'eId' => 'nullable|integer|numeric',
            'title' => 'nullable|string|min:3|max:12',
            'price' => 'nullable|numeric|min:0|max:200',
            'categoryEId' => 'nullable|array',
            'categoryEId.*' => 'integer|exists:categories,id',
        ];
    }
}
