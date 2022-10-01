<?php

namespace App\Helpers;

Class Response {
    public function createResponse(string $message, mixed $data) {
        return response([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function createErrorResponse(string $message, int $responseCode = 500) {
        return response([
            'success' => false,
            'message' => $message,
            'data' => null
        ], $responseCode);
    }
}

?>
