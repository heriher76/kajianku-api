<?php

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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
  Route::group(['middleware' => 'auth'], function () use ($router) {
    //EVENT
    $router->get('kajian', 'KajianController@index');
    $router->get('kajian/{id}', 'KajianController@show');
    $router->post('kajian/create', 'KajianController@store');
    $router->put('kajian/{id}/update', 'KajianController@update');
    $router->delete('kajian/{id}/delete', 'KajianController@destroy');
    $router->get('kajian/search/{query}', 'KajianController@search');

    //USER
    $router->get('/user/search/{query}', 'UserController@searchUser');
    $router->get('/profile', 'UserController@getProfile');
    $router->put('/profile/edit', 'UserController@editProfile');
    $router->put('/profile/password', 'UserController@editPassword');
  });
  $router->post('register', 'AuthController@register');
  $router->post('login', 'AuthController@login');
});
