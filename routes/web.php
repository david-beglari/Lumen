<?php



$router->group(['namespace' => 'API\V1'], function($authRoutes)
{
    $authRoutes->get('shops', 'ShopController@index');
    $authRoutes->get('products', 'ProductController@index');
});

