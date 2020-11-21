<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Throwable;

class ValidationException extends Exception
{
    /**
     * @var Validator
     */
    protected $validator;

    public function __construct(Validator $validator, $code = 0, Throwable $previous = null)
    {
        parent::__construct($validator->errors()->first(), $code, $previous);

        $this->validator = $validator;
    }

    /**
     * 渲染错误
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        $data = ['code' => 422, 'message' => $this->validator->errors()->first(), 'data' => []];
        return response()->json($data);
    }
}
