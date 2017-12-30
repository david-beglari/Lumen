<?php

/*$router->get('/key', function() {
    return str_random(32);
});*/

$router->post('/login', 'API\AuthController@login');

$router->group(['middleware' => 'auth', 'namespace' => 'API\V1'], function($authRoutes)
{
    $authRoutes->get('shops', 'ShopController@index');
    $authRoutes->post('shops', 'ShopController@store');
    $authRoutes->get('shops/{id}', 'ShopController@show');
    $authRoutes->delete('shops/{id}', 'ShopController@destroy');
    $authRoutes->put('shops/{id}', 'ShopController@update');

    $authRoutes->get('products', 'ProductController@index');
    $authRoutes->post('products', 'ProductController@store');
    $authRoutes->get('products/{id}', 'ProductController@show');
    $authRoutes->delete('products/{id}', 'ProductController@destroy');
    $authRoutes->put('products/{id}', 'ProductController@update');
});

