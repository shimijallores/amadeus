<?php

use Http\models\FlightSchedules;

(new FlightSchedules())->destroy(['id' => intval($_POST['id'])]);

redirect('/flight-schedules');
