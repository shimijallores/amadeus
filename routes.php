<?php

// Airlines
$router->get('/', 'airlines/index.php')->only('admin');
$router->get('/airlines', 'airlines/index.php')->only('admin');
$router->delete('/airlines', 'airlines/destroy.php')->only('admin');
$router->patch('/airlines', 'airlines/update.php')->only('admin');
$router->post('/airlines', 'airlines/store.php')->only('admin');

// Airports
$router->get('/airports', 'airports/index.php')->only('admin');
$router->delete('/airports', 'airports/destroy.php')->only('admin');
$router->patch('/airports', 'airports/update.php')->only('admin');
$router->post('/airports', 'airports/store.php')->only('admin');

// Aircraft
$router->get('/aircraft', 'aircraft/index.php')->only('admin');
$router->delete('/aircraft', 'aircraft/destroy.php')->only('admin');
$router->patch('/aircraft', 'aircraft/update.php')->only('admin');
$router->post('/aircraft', 'aircraft/store.php')->only('admin');

// Airline Users
$router->get('/airline-users', 'airline_users/index.php')->only('admin');
$router->delete('/airline-users', 'airline_users/destroy.php')->only('admin');
$router->patch('/airline-users', 'airline_users/update.php')->only('admin');

// Flight Routes
$router->get('/flight-routes', 'flight_routes/index.php')->only('admin');
$router->delete('/flight-routes', 'flight_routes/destroy.php')->only('admin');
$router->patch('/flight-routes', 'flight_routes/update.php')->only('admin');

// Flight Schedules
$router->get('/flight-schedules', 'flight_schedules/index.php')->only('admin');
$router->delete('/flight-schedules', 'flight_schedules/destroy.php')->only('admin');
$router->patch('/flight-schedules', 'flight_schedules/update.php')->only('admin');

//Login
$router->get('/login', 'authentication/login.php')->only('guest');
$router->post('/login', 'authentication/signin.php')->only('guest');

//Register
$router->get('/register', 'authentication/register.php')->only('guest');
$router->post('/register', 'authentication/signup.php')->only('guest');

//Logout
$router->delete('/logout', 'authentication/logout.php')->only('admin');
