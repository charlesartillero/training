<?php

namespace App\Traits;

trait ApiResponses
{
    protected function ok($message, $data = null){
        return $this->success($message, 200, $data);
    }

    protected function error($message, $statusCode){
        return $this->failed($message, $statusCode);
    }

    protected function success($message, $statusCode = 200, $data = null)
    {
        return $this->response($message, $statusCode, $data);
    }

    protected function failed($message, $statusCode)
    {
        return $this->response($message, $statusCode);
    }

    protected function response($message, $statusCode, $data = null)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

}
