<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse {
    protected function success(array $data, ?string $message, int $code = 200) : JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(?string $message, int $code = 500) : JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => null
        ], $code);
    }
}