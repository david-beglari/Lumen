<?php

/*$router->get('/key', function() {
    return str_random(32);
});*/

$router->post('/login', 'API\AuthController@login');

$router->group(['middleware' => 'auth', 'namespace' => 'API\V1'], function($authRoutes)
{
    $authRoutes->get('shops', 'ShopController@index');

    $authRoutes->get('products', 'ProductController@index');
});

