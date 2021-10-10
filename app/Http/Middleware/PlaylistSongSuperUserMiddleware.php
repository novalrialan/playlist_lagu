<?php

namespace App\Http\Middleware;

use App\Exceptions\PlaylistSongNotAuthorizedException;
use Closure;

class PlaylistSongSuperUserMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->fullname->role !== 'superuser') {
        throw new PlaylistSongNotAuthorizedException();
        }
        return $next($request);
    }
  
}