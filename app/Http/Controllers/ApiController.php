<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected function success(?string $message = null, ?array $data = null): JsonResponse
    {
        return $this->jsonResponse(true, $message, $data);
    }

    protected function error(?string $message = null, ?array $data = null): JsonResponse
    {
        return $this->jsonResponse(false, $message, $data, 500);
    }

    protected function jsonResponse(bool $success, ?string $message = null, ?array $data = null, int $code = 200): JsonResponse
    {
        $response = compact('success');
        if (null !== $message) {
            $response['message'] = $message;
        }
        if (null !== $data) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }
}
