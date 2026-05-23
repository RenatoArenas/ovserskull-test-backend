<?php

namespace App\Dto;

class CategoryDto
{
    public ?string $id;
    public string $name;

    public function fromArray(array $data): self
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}