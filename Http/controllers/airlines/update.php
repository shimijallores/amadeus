<?php

use Http\forms\AirlinesForm;
use Http\models\Airlines;


$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'iata' => $_POST['iata'],
    'icao' => $_POST['icao'],
    'airline' => $_POST['airline'],
    'callsign' => $_POST['callsign'],
    'country' => $_POST['country'],
    'comments' => $_POST['comments'],
];

AirlinesForm::validate($attributes);

(new Airlines())->update($attributes);

redirect('/');
