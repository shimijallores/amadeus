<?php

use Http\forms\AirportsForm;
use Http\models\Airports;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'iata' => $_POST['iata'],
    'icao' => $_POST['icao'],
    'airport_name' => $_POST['airport_name'],
    'location_served' => $_POST['location_served'],
    'time' => $_POST['time'],
    'dst' => $_POST['dst'],
];

AirportsForm::validate($attributes);

(new Airports())->update($attributes);

redirect('/airports');
