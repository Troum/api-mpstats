<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function success(string|array $data): JsonResponse
    {
        $success = [
            'success' => true,
            'message' => null
        ];

        $response = array_merge($success, is_array($data) ? $data : [$data]);

        return response()->json($response, 200);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function error(string $message): JsonResponse
    {
        return response()->json(
                [
                    'status' => false,
                    'error' => $message
                ], 400
            );
    }
}
