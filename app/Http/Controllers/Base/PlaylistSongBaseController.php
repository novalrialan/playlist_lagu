<?php

namespace App\Http\Controllers\Base;

use App\Exceptions\PlaylistSongNotAuthenticatedException;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Model\User;

abstract class PlaylistSongBaseController extends BaseController
{
    public function __construct()
    {
        $token = request()->header('api_token');
        $user = User::where('api_token','=',$token)->first();
        if ($user === null) {
            throw new PlaylistSongNotAuthenticatedException();
        }
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