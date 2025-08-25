<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

// Join flight_schedules with related tables to get readable names
$flight_schedules = $db->query("
    SELECT fs.*, 
           au.user as airline_user_name,
           a.airline as airline_name,
           orig.airport_name as origin_airport_name,
           dest.airport_name as destination_airport_name,
           CONCAT(orig.airport_name, ' → ', dest.airport_name) as route_display
    FROM flight_schedules fs
    LEFT JOIN airline_users au ON fs.airline_user_id = au.id
    LEFT JOIN flight_routes fr ON fs.flight_route_id = fr.id
    LEFT JOIN airlines a ON au.airline_id = a.id
    LEFT JOIN airports orig ON fr.origin_airport_id = orig.id
    LEFT JOIN airports dest ON fr.destination_airport_id = dest.id
")->get();

// Get all reference data for dropdowns
$airline_users = $db->query("
    SELECT au.id, au.user, a.airline 
    FROM airline_users au
    LEFT JOIN airlines a ON au.airline_id = a.id
")->get();

$flight_routes = $db->query("
    SELECT fr.id, 
           CONCAT(orig.airport_name, ' → ', dest.airport_name, ' (', ac.model, ')') as route_display
    FROM flight_routes fr
    LEFT JOIN airports orig ON fr.origin_airport_id = orig.id
    LEFT JOIN airports dest ON fr.destination_airport_id = dest.id
    LEFT JOIN aircraft ac ON fr.aircraft_id = ac.id
")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/flight_schedules/index.view.php');
