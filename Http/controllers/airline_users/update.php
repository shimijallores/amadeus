<?php

use Http\forms\AirlineUsersForm;
use Http\models\AirlineUsers;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'airline_id' => intval($_POST['airline_id']),
    'user' => $_POST['user'],
    'password' => $_POST['password'],
    'type' => $_POST['type'],
];

AirlineUsersForm::validate($attributes);

(new AirlineUsers())->update($attributes);

redirect('/airline-users');
