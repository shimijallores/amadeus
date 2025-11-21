<?php

use Http\forms\FlightSchedulesForm;
use Http\models\FlightSchedules;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'airline_user_id' => intval($_POST['airline_user_id']),
    'flight_route_id' => intval($_POST['flight_route_id']),
    'date_departure' => $_POST['date_departure'],
    'time_departure' => $_POST['time_departure'],
    'date_arrival' => $_POST['date_arrival'],
    'time_arrival' => $_POST['time_arrival'],
    'price_f' => $_POST['price_f'],
    'price_c' => $_POST['price_c'],
    'price_y' => $_POST['price_y'],
    'status' => $_POST['status'],
];

FlightSchedulesForm::validate($attributes);

(new FlightSchedules())->update($attributes);

redirect('/flight-schedules');
