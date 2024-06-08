<?php


namespace App\Exceptions;


use Exception;

class PlaylistSongNotAuthorizedException extends Exception
{
public function render()
    {
    return response()->json([
       'status'=>'failed',
       'message'=>'You do not have access rights to this endpoint', 
    ],403);
    }    
   
}