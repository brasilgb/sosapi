<?php

namespace App\Traits;

trait HttpResponses
{
    public function response($message, $status, $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ], $status);
    }

    public function error($message, $status, $erros = [], $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'errors' => $erros,
            'data' => $data
        ], $status);
    }
}
