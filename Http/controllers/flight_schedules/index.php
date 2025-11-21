<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

// Join flight_schedules with related tables to get readable names
$query = "
    SELECT fs.*, 
           au.username as airline_user_name,
           a.airline as airline_name,
           s.id as seat_id,
           s.flight_schedule_id,
           s.ticket_id,
           s.seat_no,
           s.row,
           s.column,
           s.class,
           s.status as seat_status,
           orig.airport_name as origin_airport_name,
           dest.airport_name as destination_airport_name,
           fs.date_departure,
           fs.date_arrival,
           fs.status,
           fs.price_f,
           fs.price_c,
           fs.price_y,
           craft.model,
           craft.rows,
           craft.columns,
           CONCAT(orig.airport_name, ' → ', dest.airport_name) as route_display
    FROM flight_schedules fs
    LEFT JOIN airline_users au ON fs.airline_user_id = au.id
    LEFT JOIN flight_routes fr ON fs.flight_route_id = fr.id
    LEFT JOIN airlines a ON au.airline_id = a.id
    LEFT JOIN airports orig ON fr.origin_airport_id = orig.id
    LEFT JOIN airports dest ON fr.destination_airport_id = dest.id
    LEFT JOIN seats s ON s.flight_schedule_id = fs.id
    LEFT JOIN aircraft craft ON craft.id = fs.aircraft_id
";

$params = [];
$selectedRoute = false;

if (isset($_GET['schedule'])) {
    $query .= " WHERE fr.id = :id";
    $params[':id'] = $_GET['schedule'];

    $selectedRoute = $db->query(
        "SELECT a.airline 
         FROM airlines a 
         LEFT JOIN flight_routes fr ON fr.airline_id = a.id  
         WHERE fr.id = :id",
        [':id' => $_GET['schedule']]
    )->find();
}

// Force fetch ALL rows instead of one
$rows = $db->query($query, $params)->get();

$schedules = [];

foreach ($rows as $row) {
    $fs_id = $row['id']; // flight_schedules.id

    if (!isset($schedules[$fs_id])) {
        $schedules[$fs_id] = [
            'id' => $row['id'],
            'airline_user_name' => $row['airline_user_name'],
            'airline_name' => $row['airline_name'],
            'origin_airport_name' => $row['origin_airport_name'],
            'destination_airport_name' => $row['destination_airport_name'],
            'route_display' => $row['route_display'],
            'date_departure' => $row['date_departure'],
            'date_arrival' => $row['date_arrival'],
            'status' => $row['status'],
            'price_f' => $row['price_f'],
            'price_c' => $row['price_c'],
            'price_y' => $row['price_y'],
            'seats' => []
        ];
    }

    if (!empty($row['seat_id'])) {
        $schedules[$fs_id]['seats'][] = [
            'seat_id' => $row['seat_id'],
            'flight_schedule_id' => $row['flight_schedule_id'],
            'ticket_id' => $row['ticket_id'],
            'model' => $row['model'],
            'seat_no' => $row['seat_no'],
            'row' => $row['row'],
            'column' => $row['column'],
            'rows' => $row['rows'],
            'columns' => $row['columns'],
            'class' => $row['class'],
            'seat_status' => $row['seat_status']
        ];
    }
}

// Reindex array (optional, for clean JSON)
$flight_schedules = array_values($schedules);

// Get all reference data for dropdowns
$airline_users = $db->query("
    SELECT au.id, au.username, a.airline 
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
