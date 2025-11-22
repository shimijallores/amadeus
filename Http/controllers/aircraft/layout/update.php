<?php

use Http\forms\AircraftForm;
use Http\models\Aircraft;

$attributes = [
  'id' => intval($_POST['aircraft_id']),
  'method' => 'PATCH',
  'layout' => $_POST['layout'],
  'rows' => $_POST['rows'],
  'columns' => $_POST['columns'],
  'seats_f' => $_POST['seats_f'],
  'seats_c' => $_POST['seats_c'],
  'seats_y' => $_POST['seats_y'],
];

(new Aircraft())->update_layout($attributes);

redirect('/aircraft');
