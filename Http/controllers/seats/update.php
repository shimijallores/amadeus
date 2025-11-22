<?php

use Http\forms\SeatsForm;
use Http\models\Seats;

$attributes = [
  'id' => intval($_POST['seat_id']),
  'method' => 'PATCH',
  'status' => $_POST['status'],
  'price' => $_POST['price'],
  'ticket_id' => $_POST['ticket_id'],
  'customer_name' => $_POST['customer_name'],
  'customer_number' => $_POST['customer_number'],
  'agency_number' => $_POST['agency_number'],
];

SeatsForm::validate($attributes);

(new Seats())->update($attributes);

redirect('/flight-schedules');
