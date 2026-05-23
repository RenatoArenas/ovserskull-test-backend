<?php

namespace App\Http\Controllers;

use App\Dto\CategoryDto;
use App\Services\CategoryService;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Traits\ApiResponse;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    use ApiResponse;

    public function __construct(private CategoryService $categoryService)
    {
    }

    #[OA\Get(
        path: '/api/categories',
        summary: 'Listar todas las categorías',
        tags: ['Categories'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categorías listadas correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Categorias listadas correctamente'),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: '#/components/schemas/Category')
                        ),
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->success($categories->toArray(), 'Categorias listadas correctamente');
    }

    #[OA\Get(
        path: '/api/categories/{id}',
        summary: 'Obtener una categoría por ID',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID de la categoría',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categoría obtenida correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Categoría obtenida correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Category'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Categoría no encontrada')
        ]
    )]
    public function show(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return $this->success($category->toArray(), 'Categoría obtenida correctamente');
    }

    #[OA\Post(
        path: '/api/categories',
        summary: 'Crear una nueva categoría',
        tags: ['Categories'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/AddCategoryRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categoría creada correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Categoría creada correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Category'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Error de validación',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'El campo name es requerido'),
                        new OA\Property(property: 'errors', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function store(AddCategoryRequest $request)
    {
        $categoryDto = new CategoryDto();
        $categoryDto->fromArray($request->all());
        $category = $this->categoryService->createCategory($categoryDto);
        return $this->success($category->toArray(), 'Categoría creada correctamente');
    }

    #[OA\Put(
        path: '/api/categories/{id}',
        summary: 'Actualizar una categoría',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID de la categoría',
                schema: new OA\Schema(type: 'string')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateCategoryRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categoría actualizada correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Categoría actualizada correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Category'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Categoría no encontrada'),
            new OA\Response(response: 422, description: 'Error de validación')
        ]
    )]
    public function update(string $id, UpdateCategoryRequest $request)
    {
        $categoryDto = new CategoryDto();
        $categoryDto->fromArray($request->all());
        $category = $this->categoryService->updateCategory($id, $categoryDto);
        return $this->success($category->toArray(), 'Categoría actualizada correctamente');
    }

    #[OA\Delete(
        path: '/api/categories/{id}',
        summary: 'Eliminar una categoría',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID de la categoría',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categoría eliminada correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Categoría eliminada correctamente'),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(), // <-- fix
                            example: []
                        ),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Categoría no encontrada')
        ]
    )]
    public function destroy(string $id)
    {
        $this->categoryService->deleteCategory($id);
        return $this->success([], 'Categoría eliminada correctamente');
    }
}
