<?php

use Http\forms\AirlineUsersForm;
use Http\models\AirlineUsers;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'airline_id' => intval($_POST['airline_id']),
    'username' => $_POST['username'],
    'role' => $_POST['role'],
];

AirlineUsersForm::validate($attributes);

(new AirlineUsers())->update($attributes);

redirect('/airline-users');
