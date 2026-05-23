<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\JsonRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends JsonRequest
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
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'category_id' => 'required|uuid|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El campo name debe ser una cadena de texto',
            'name.max' => 'El campo name debe tener como máximo 255 carácteres',
            'description.string' => 'El campo description debe ser una cadena de texto',
            'description.max' => 'El campo description debe tener como máximo 255 carácteres',
            'price.numeric' => 'El campo price debe ser numérico',
            'stock.required' => 'El campo stock debe ser requerido',
            'stock.numeric' => 'El campo stock debe ser numérico',
            'category_id.uuid' => 'El campo category_id debe ser un uuid válido',
            'category_id.exists' => 'La categoría no existe',
        ];
    }
}
