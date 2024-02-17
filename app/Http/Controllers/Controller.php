<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function respondWithSuccess($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function responseWithCreated($data = null, $message = 'Created')
    {
        return $this->respondWithSuccess($data, $message, 201);
    }

    public function respondWithError($message = 'Error', $code = 400)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], $code);
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->respondWithError($message, 404);
    }

    public function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respondWithError($message, 401);
    }
}
