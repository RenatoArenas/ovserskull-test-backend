<?php

namespace App\Services;

use App\Dto\CategoryDto;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories() : Collection
    {
        return Category::all();
    }

    public function getCategoryById(string $id) : Category
    {
        $category = Category::find($id);

        if (!$category) {
            throw new \Exception('Categoría no encontrada', 400);
        }

        return $category;
    }

    public function createCategory(CategoryDto $data) : Category
    {
        return Category::create($data->toArray());
    }

    public function updateCategory(string $id, CategoryDto $data) : Category
    {
        $category = Category::find($id);

        if (!$category) {
            throw new \Exception('Categoría no encontrada', 400);
        }
        
        $category->update($data->toArray());
        return $category;
    }

    public function deleteCategory(string $id) : bool
    {
        $category = Category::find($id);

        if (!$category) {
            throw new \Exception('Categoría no encontrada', 400);
        }

        return $category->delete();
    }
}