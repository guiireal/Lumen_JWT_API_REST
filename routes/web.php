<?php


$router->group(['prefix' => 'users'], function() use ($router) {
    $router->get('/', 'UserController@index');
    $router->post('/', 'UserController@store');
    $router->get('{id}', 'UserController@show');
    $router->put('{id}', 'UserController@update');
    $router->delete('{id}', 'UserController@destroy');
    $router->post('info', 'UserController@info');
});

$router->post('/login', 'UserController@login');
$router->post('/logout', 'UserController@logout');


