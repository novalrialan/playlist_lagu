<?php

namespace App\Http\Middleware;

use App\Exceptions\PlaylistSongNotAuthenticatedException;
use Closure;
use App\Model\User;

class PlaylistSongMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->header('api_token'))) {
            # kondisi ketika api_token tidak dikirim melalui header
            throw new PlaylistSongNotAuthenticatedException();
        }
        # kondisi token tidak kosong
        $token = request()->header('api_token');
        $user = User::where('api_token','=',$token)->first();
        if($user === null){
            throw new PlaylistSongNotAuthenticatedException();
        }
        # kondisi ketika api_tokennya ada
        $request->fullname = $user;
        return $next($request);
    }
}