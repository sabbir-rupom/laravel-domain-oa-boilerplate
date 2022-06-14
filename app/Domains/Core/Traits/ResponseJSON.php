<?php

namespace App\Domains\Core\Traits;

trait ResponseJSON
{
    private $jsonResponse = [
        'success' => false,
        'message' => "",
        'html' => false,
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
