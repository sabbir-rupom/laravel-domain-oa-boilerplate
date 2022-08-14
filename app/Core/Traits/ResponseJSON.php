<?php

namespace App\Core\Traits;

trait ResponseJSON
{
    private $jsonResponse = [
        'success' => false,
        'message' => "",
        'data' => [],
    ];

    protected function response(array $response = [], int $httpStatus = 200, array $headers = [])
    {
        return response()->json(
            array_replace(
                $this->jsonResponse,
                $response
            ),
            $httpStatus,
            $headers
        );
    }
}
