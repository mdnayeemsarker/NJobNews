<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * Return an API response based on status.
     *
     * @param bool $status
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respond($data, $status, $message, $statusCode)
    {
        $response = [
            'success' => $status,
            'code' => $statusCode,
            'message' => $message,
            $status ? 'data' : 'error' => $data,
        ];
        return response()->json($response, $statusCode);
    }
}
