<?php

namespace Api\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


trait ApiResponse
{
    protected $statusCode = Response::HTTP_OK;


    protected function success($data = [], string $message = "Success", int $code = Response::HTTP_OK)
    {
        return response()->json([
            "status" => true,
            "message" => $message,
            'data' => $data
        ], $code);
    }

    protected function error(string $message = 'Error', int $code = Response::HTTP_BAD_REQUEST, $data = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function validationError($validator, int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'data' => $validator->errors(),
        ], $code);
    }
}