<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApiResponses
{
    public function ok($message, $data = [])
    {
        return $this->success($message, $data, 200);
    }


    public function success($message, $data = [], $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $code
        ], $code);
    }


    public function error($errors = [], $statusCode = null)
    {

        //if error is a single line of a string then it immediate returns
        if (is_string($errors)) {
            return response()->json([
                'message' => $errors,
                'status' => $statusCode
            ], $statusCode);
        }

        //other wise it render whole bunch of info
        return response()->json([
            'errors' => $errors
        ]);
    }


    public function notAuthorized($message)
    {
        return $this->error([
            'status' => '401',
            'message' => $message,
            'source' => ''
        ]);
    }
}
