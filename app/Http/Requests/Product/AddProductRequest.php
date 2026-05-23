<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\JsonRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|uuid|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.string' => 'El campo name debe ser una cadena de texto',
            'name.max' => 'El campo name debe tener como máximo 255 carácteres',
            'description.required' => 'El campo description es requerido',
            'description.string' => 'El campo description debe ser una cadena de texto',
            'description.max' => 'El campo description debe tener como máximo 255 carácteres',
            'price.required' => 'El campo price es requerido',
            'price.numeric' => 'El campo price debe ser numérico',
            'stock.required' => 'El campo stock debe ser requerido',
            'stock.numeric' => 'El campo stock debe ser numérico',
            'category_id.required' => 'El campo category_id es requerido',
            'category_id.uuid' => 'El campo category_id debe ser un uuid válido',
            'category_id.exists' => 'La categoría no existe',
        ];
    }
}
