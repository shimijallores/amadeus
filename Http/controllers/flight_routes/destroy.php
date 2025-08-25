<?php

use Http\models\FlightRoutes;

(new FlightRoutes())->destroy(['id' => intval($_POST['id'])]);

redirect('/flight-routes');
