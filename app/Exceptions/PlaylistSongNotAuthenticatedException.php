<?php


namespace App\Exceptions;

use Exception;

class PlaylistSongNotAuthenticatedException extends Exception
{
public function render()
{
    return response()->json([
       'status'=>'failed',
       'message'=>'you are not Authenticated', 
    ],401);
    }    
}