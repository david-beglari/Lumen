<?php



$router->group(['namespace' => 'API\V1'], function($authRoutes)
{
    $authRoutes->get('/', 'ShopController@index');
});

