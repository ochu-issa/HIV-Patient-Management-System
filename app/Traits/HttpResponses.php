<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait HttpResponses
{
    //success responses
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ], $code);
    }

    //error responses
    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], $code);
    }

    protected static function recordFailed($message){
        return response()->json(['error' => 'Something went wrong while creating the record. Please try again later.', 'message' => $message],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)->setStatusCode(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        ]);
    }

    protected static function recordedCreated($data){
        return \response()->json([
            'data'=> $data,
            'message' => 'Record Created successful',
            'status' => ResponseAlias::HTTP_CREATED
        ],ResponseAlias::HTTP_CREATED);
    }
}
