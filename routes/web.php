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

$router->post('api/v3/login','Auth\LoginController@verify');

$router->group(['prefix'=>'api/v3','middleware'=>'playlistsong.auth'],function ($router){

    $router->get('/playlists','PlaylistController@getAllName');
    
    $router->get('/playlists','PlaylistController@getByUserId');
    # to Get All data
    $router->get('/songs','SongController@getAll');

    # to get data by id 
    $router->get('/songs/{id}','SongController@getById');
    
    #to create data
    $router->post('/songs','SongController@create');
    
    #to update data
    $router->put('/songs/{id}','SongController@update');

    #to delete data
    // $router->delete('/songs/{id}','SongController@delete');

    #single route
    $router->delete('/songs/{id}',[
        'middleware'=>'playlistsong.superuser',
        'uses'=>'SongController@delete'
    ]);
});