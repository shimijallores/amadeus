<?php

use Http\models\AirlineUsers;

(new AirlineUsers())->destroy(['id' => intval($_POST['id'])]);

redirect('/airline-users');
