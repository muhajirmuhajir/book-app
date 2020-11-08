<?php

namespace App\Helpers;

class ResponseFormatter{


    public static function success( $data, $message = 'success')
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function error($message = 'error', $code=500)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}
