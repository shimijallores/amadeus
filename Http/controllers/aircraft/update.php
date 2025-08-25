<?php

use Http\forms\AircraftForm;
use Http\models\Aircraft;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'iata' => $_POST['iata'],
    'icao' => $_POST['icao'],
    'model' => $_POST['model'],
];

AircraftForm::validate($attributes);

(new Aircraft())->update($attributes);

redirect('/aircraft');
