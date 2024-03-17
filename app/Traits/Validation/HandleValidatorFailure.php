<?php

namespace App\Traits\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HandleValidatorFailure
{

    /**
     * Format the way of handling validation failure
     */
    protected function handleValidatorFailure(Validator $validator)
    {
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
