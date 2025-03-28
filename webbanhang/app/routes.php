<?php
// Existing routes...

// API Routes
$router->get('/webbanhang/api/product', 'ProductApiController@index');
$router->get('/webbanhang/api/product/search', 'ProductApiController@search');
$router->get('/webbanhang/api/product/:id', 'ProductApiController@show');
$router->delete('/webbanhang/api/product/:id', 'ProductApiController@delete');
$router->post('/webbanhang/api/product', 'ProductApiController@create');

// ... rest of your routes 