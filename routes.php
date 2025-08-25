<?php

// Airlines
$router->get('/', 'airlines/index.php');
$router->delete('/airlines', 'airlines/destroy.php');
$router->patch('/airlines', 'airlines/update.php');

// Airports
$router->get('/airports', 'airports/index.php');
$router->delete('/airports', 'airports/destroy.php');
$router->patch('/airports', 'airports/update.php');

// Aircraft
$router->get('/aircraft', 'aircraft/index.php');
$router->delete('/aircraft', 'aircraft/destroy.php');
$router->patch('/aircraft', 'aircraft/update.php');

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
