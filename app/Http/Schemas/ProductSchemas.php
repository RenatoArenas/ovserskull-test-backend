<?php

namespace App\Http\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Product',
    title: 'Product',
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid', example: '550e8400-e29b-41d4-a716-446655440000'),
        new OA\Property(property: 'name', type: 'string', example: 'Laptop HP'),
        new OA\Property(property: 'description', type: 'string', example: 'Laptop HP 15 pulgadas'),
        new OA\Property(property: 'price', type: 'number', format: 'float', example: 999.99),
        new OA\Property(property: 'stock', type: 'number', example: 50),
        new OA\Property(property: 'category_id', type: 'string', format: 'uuid', example: '550e8400-e29b-41d4-a716-446655440000'),
    ]
)]

#[OA\Schema(
    schema: 'AddProductRequest',
    title: 'AddProductRequest',
    required: ['name', 'description', 'price', 'stock', 'category_id'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'Laptop HP'),
        new OA\Property(property: 'description', type: 'string', maxLength: 255, example: 'Laptop HP 15 pulgadas'),
        new OA\Property(property: 'price', type: 'number', format: 'float', example: 999.99),
        new OA\Property(property: 'stock', type: 'number', example: 50),
        new OA\Property(property: 'category_id', type: 'string', format: 'uuid', example: '550e8400-e29b-41d4-a716-446655440000'),
    ]
)]

#[OA\Schema(
    schema: 'UpdateProductRequest',
    title: 'UpdateProductRequest',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, nullable: true, example: 'Laptop HP'),
        new OA\Property(property: 'description', type: 'string', maxLength: 255, nullable: true, example: 'Laptop HP 15 pulgadas'),
        new OA\Property(property: 'price', type: 'number', format: 'float', nullable: true, example: 999.99),
        new OA\Property(property: 'stock', type: 'number', nullable: true, example: 50),
        new OA\Property(property: 'category_id', type: 'string', format: 'uuid', nullable: true, example: '550e8400-e29b-41d4-a716-446655440000'),
    ]
)]
class ProductSchemas {}