<?php

namespace App\Helper;

use App\Http\Resources\UserRessource;

class ApiResponse
{

    public static function success($message = null , $data = [] , $status="success" ,  $statusCode=200){
        return response()->json([
            "status" =>  $status,
            "message" => $message,
            "data" => $data
        ],$statusCode);
    }

    public static function error($message,$status="error",$statusCode=200){
        return response()->json([
            "status" =>  $status,
            "message" => $message,
        ],$statusCode);
    }
}
