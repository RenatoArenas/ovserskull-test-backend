<?php

namespace App\Http\Controllers;

use App\Dto\ProductDto;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Traits\ApiResponse;
use OpenApi\Attributes as OA;


class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(private ProductService $productService) {}

    #[OA\Get(
        path: '/api/products',
        summary: 'Listar todos los productos',
        tags: ['Products'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Productos listados correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Productos listados correctamente'),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: '#/components/schemas/Product')
                        ),
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return $this->success($products->toArray(), 'Productos listados correctamente');
    }

    #[OA\Get(
        path: '/api/products/{id}',
        summary: 'Obtener un producto por ID',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del producto',
                schema: new OA\Schema(type: 'string', format: 'uuid')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto obtenido correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto obtenido correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Product'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Producto no encontrado')
        ]
    )]
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        return $this->success($product->toArray(), 'Producto obtenido correctamente');
    }

    #[OA\Post(
        path: '/api/products',
        summary: 'Crear un nuevo producto',
        tags: ['Products'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/AddProductRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto creado correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto creado correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Product'),
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
    public function store(AddProductRequest $request)
    {
        $productDto = new ProductDto();
        $productDto->fromArray($request->all());
        $product = $this->productService->createProduct($productDto);
        return $this->success($product->toArray(), 'Producto creado correctamente');
    }

    #[OA\Put(
        path: '/api/products/{id}',
        summary: 'Actualizar un producto',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del producto',
                schema: new OA\Schema(type: 'string', format: 'uuid')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateProductRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto actualizado correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto actualizado correctamente'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Product'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Producto no encontrado'),
            new OA\Response(response: 422, description: 'Error de validación')
        ]
    )]
    public function update(string $id, UpdateProductRequest $request)
    {
        $productDto = new ProductDto();
        $productDto->fromArray($request->all());
        $product = $this->productService->updateProduct($id, $productDto);
        return $this->success($product->toArray(), 'Producto actualizado correctamente');
    }

    #[OA\Delete(
        path: '/api/products/{id}',
        summary: 'Eliminar un producto',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del producto',
                schema: new OA\Schema(type: 'string', format: 'uuid')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto eliminado correctamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto eliminado correctamente'),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(), // <-- fix
                            example: []
                        ),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Producto no encontrado')
        ]
    )]
    public function destroy(string $id)
    {
        $this->productService->deleteProduct($id);
        return $this->success([], 'Producto eliminado correctamente');
    }
}