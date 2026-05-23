<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\JsonRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El campo name debe ser una cadena de texto',
            'name.max' => 'El campo name debe tener como máximo 255 carácteres',
        ];
    }
}
