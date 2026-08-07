<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait WithReturnResponse
{
    public function responseWithSuccess(mixed $data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function responseWithCreated(mixed $data = null, string $message = 'Created'): JsonResponse
    {
        return $this->responseWithSuccess($data, $message, 201);
    }

    public function responseWithError(string $message = 'Error', int $code = 400): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], $code);
    }

    public function responseNotFound(string $message = 'Not Found'): JsonResponse
    {
        return $this->responseWithError($message, 404);
    }

    public function responseUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->responseWithError($message, 401);
    }
}
