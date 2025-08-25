<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

// Join flight_routes with related tables to get names
$flight_routes = $db->query("
    SELECT fr.*, 
           a.airline as airline_name,
           orig.airport_name as origin_airport_name,
           dest.airport_name as destination_airport_name,
           ac.model as aircraft_model
    FROM flight_routes fr
    LEFT JOIN airlines a ON fr.airline_id = a.id
    LEFT JOIN airports orig ON fr.origin_airport_id = orig.id
    LEFT JOIN airports dest ON fr.destination_airport_id = dest.id
    LEFT JOIN aircraft ac ON fr.aircraft_id = ac.id
")->get();

// Get all reference data for dropdowns
$airlines = $db->query("SELECT id, airline FROM airlines")->get();
$airports = $db->query("SELECT id, airport_name FROM airports")->get();
$aircraft = $db->query("SELECT id, model FROM aircraft")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/flight_routes/index.view.php');
