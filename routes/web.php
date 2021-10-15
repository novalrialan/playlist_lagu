<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Laravel\Lumen\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
date_default_timezone_set('Asia/Jakarta');

$router->post('api/v3/login','Auth\LoginController@verify');

$router->group(['prefix'=>'api/v3','middleware'=>'playlistsong.auth'],function ($router){
    
    /**
     * =========== superuser ====================
     * */ 
    
    #superuser dapat membuat user baru
    $router->post('/users',['middleware'=>'playlistsong.superuser','uses'=>'UserController@createUser']);
    
    #superuser mendapatkan semua data user
    $router->get('/users',['middleware'=>'playlistsong.superuser','uses'=>'UserController@getAllUser']);

    #superuser menambah data lagu
    $router->post('/songs',['middleware'=>'playlistsong.superuser','uses'=>'SongController@createSong']);
    
    #superuser dapat mangubah lagu dengan id tertentu (belum tervalidasi)
    // $router->get('/songs/{id}',['middleware'=>'playlistsong.superuser','uses'=>'SongController@getByIdSong']);
    
    #superuser mengubah data lagu dengan id tertentu (superuser dapat mengUpdate lagu)
    $router->put('/songs/{id}',['middleware'=>'playlistsong.superuser','uses'=>'SongController@updateSong']);
    
    #delete
    $router->delete('/songs/{id}',['middleware'=>'playlistsong.superuser','uses'=>'SongController@deleteSong']);

    /**
     * ========== playlist =============================
    */
    $router->get('/playlists/{id}','PlaylistController@getPlayistUserId');

    // $router->post('/playlists','PlaylistController@createPlaylist');
    
    
    /**
     * ========== user =============================
     * */ 
    #user dapat semua data lagu
    $router->get('/songs','SongController@getAllSong');
    
    #user mendapatkan lagu dengan id tertentu
    $router->get('/songs/{id}','SongController@getByIdSong');

    
    #to delete data
    // $router->delete('/songs/{id}','SongController@deleteSong');

    
    
});