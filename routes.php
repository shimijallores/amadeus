<?php

// Airlines
$router->get('/airlines', 'airlines/index.php');
$router->delete('/airlines', 'airlines/destroy.php');
$router->patch('/airlines', 'airlines/update.php');
$router->post('/airlines', 'airlines/store.php');

// Airports
$router->get('/airports', 'airports/index.php');
$router->delete('/airports', 'airports/destroy.php');
$router->patch('/airports', 'airports/update.php');

// Aircraft
$router->get('/aircraft', 'aircraft/index.php');
$router->delete('/aircraft', 'aircraft/destroy.php');
$router->patch('/aircraft', 'aircraft/update.php');

// Airline Users
$router->get('/airline-users', 'airline_users/index.php');
$router->delete('/airline-users', 'airline_users/destroy.php');
$router->patch('/airline-users', 'airline_users/update.php');

// Flight Routes
$router->get('/flight-routes', 'flight_routes/index.php');
$router->delete('/flight-routes', 'flight_routes/destroy.php');
$router->patch('/flight-routes', 'flight_routes/update.php');

// Flight Schedules
$router->get('/flight-schedules', 'flight_schedules/index.php');
$router->delete('/flight-schedules', 'flight_schedules/destroy.php');
$router->patch('/flight-schedules', 'flight_schedules/update.php');

//Login
$router->get('/login', 'login/index.php');
$router->post('/login', 'login/verify.php');

//Logout
$router->delete('/logout', 'login/logout.php');
