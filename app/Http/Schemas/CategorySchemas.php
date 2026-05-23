<?php

namespace App\Http\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Category',
    title: 'Category',
    properties: [
        new OA\Property(property: 'id', type: 'string', example: '1'),
        new OA\Property(property: 'name', type: 'string', example: 'Electrónica'),
    ]
)]

#[OA\Schema(
    schema: 'AddCategoryRequest',
    title: 'AddCategoryRequest',
    required: ['name'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'Electrónica'),
    ]
)]

#[OA\Schema(
    schema: 'UpdateCategoryRequest',
    title: 'UpdateCategoryRequest',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, nullable: true, example: 'Electrónica'),
    ]
)]
class CategorySchemas {}