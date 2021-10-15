<?php

namespace App\Http\Controllers\Base;

use Laravel\Lumen\Routing\Controller as BaseController;

abstract class PlaylistSongBaseController extends BaseController
{
    public function __construct()
    {
     
    }
    protected function successResponse(array $data,int $httpCode = 200)
    {
        
     $response = [
         'status'=>'succeed',
         'message'=>'request successfully processed',
         'data'=> $data
     ];
     return response()->json($response,$httpCode);
    }
 
    protected function failedResponse(array $data,int $httpCode)
    {
     $response = [
         'status'=>'failed',
         'message'=>'request failed to process',
         'data'=> $data
     ];
     return response()->json($response,$httpCode);
    }
}