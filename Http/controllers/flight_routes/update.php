<?php

use Http\forms\FlightRoutesForm;
use Http\models\FlightRoutes;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'airline_id' => intval($_POST['airline_id']),
    'origin_airport_id' => intval($_POST['origin_airport_id']),
    'destination_airport_id' => intval($_POST['destination_airport_id']),
    'round_trip' => isset($_POST['round_trip']) ? intval($_POST['round_trip']) : 0,
    'aircraft_id' => intval($_POST['aircraft_id']),
];

FlightRoutesForm::validate($attributes);

(new FlightRoutes())->update($attributes);

redirect('/flight-routes');
