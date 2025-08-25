<?php

// Airlines
$router->get('/', 'airlines/index.php');
$router->delete('/airlines', 'airlines/destroy.php');
$router->patch('/airlines', 'airlines/update.php');

//Login
$router->get('/login', 'login/index.php');
$router->post('/login', 'login/verify.php');

//Logout
$router->delete('/logout', 'login/logout.php');

//Example resource routes
$router->get('/products', 'products/index.php');
$router->post('/products', 'products/store.php');
$router->delete('/products', 'products/destroy.php');
$router->get('/product', 'products/edit.php');
$router->patch('/products', 'products/update.php');