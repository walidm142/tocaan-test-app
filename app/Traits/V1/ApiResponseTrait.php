<?php

namespace App\Traits\V1;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Return a success JSON response.
     *
     * @param mixed $data The data to include in the response.
     * @param string $message A descriptive message for the response.
     * @param int $statusCode The HTTP status code.
     * @return JsonResponse
     */
    protected function successResponse($data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message The error message.
     * @param array $errors An array of error details.
     * @param int $statusCode The HTTP status code.
     * @return JsonResponse
     */
    protected function errorResponse(string $message = 'Error', array $errors = [], int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}