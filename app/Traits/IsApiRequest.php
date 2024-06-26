<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

trait isApiRequest {
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 400,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));
    }
}
