<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function getAllProducts() : Collection
    {
        return Product::all();
    }

    public function getProductById(string $id) : Product
    {        
        $product = Product::find($id);

        if (!$product) {
            throw new \Exception('Producto no encontrado', 400);
        }

        return $product;
    }

    public function createProduct(ProductDto $data) : Product
    {
        return Product::create($data->toArray());
    }

    public function updateProduct(string $id, ProductDto $data) : Product
    {
        $product = Product::find($id);

        if (!$product) {
            throw new \Exception('Producto no encontrado', 400);
        }

        $product->update($data->toArray());
        return $product;
    }

    public function deleteProduct(string $id) : bool
    {
        $product = Product::find($id);

        if (!$product) {
            throw new \Exception('Producto no encontrado', 400);
        }

        return $product->delete();
    }
}
