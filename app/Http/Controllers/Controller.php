<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseWithSuccess($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function responseWithCreated($data = null, $message = 'Created')
    {
        return $this->responseWithSuccess($data, $message, 201);
    }

    public function responseWithError($message = 'Error', $code = 400)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], $code);
    }

    public function responseNotFound($message = 'Not Found')
    {
        return $this->responseWithError($message, 404);
    }

    public function responseUnauthorized($message = 'Unauthorized')
    {
        return $this->responseWithError($message, 401);
    }
}
