<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * return success message
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($message, $data = [])
    {
        return $this->response(200, $message, $data);
    }

    /**
     * return error message
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message, $data = [])
    {
        return $this->response(400, $message, $data);
    }

    /**
     * response to client
     *
     * @param $code
     * @param $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($code, $message, $data)
    {
        return response()->json(['message' => $message, 'code' => $code, 'data' => $data]);
    }
}
