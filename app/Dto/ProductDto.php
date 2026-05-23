<?php

namespace App\Dto;

class ProductDto
{
    public ?string $id;
    public string $name;
    public string $description;
    public float $price;
    public float $stock;
    public string $categoryId;

    public function fromArray(array $data): self
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];
        $this->categoryId = $data['category_id'];
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id ,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price ?? 0,
            'stock' => $this->stock ?? 0,
            'category_id' => $this->categoryId,
        ];
    }
}