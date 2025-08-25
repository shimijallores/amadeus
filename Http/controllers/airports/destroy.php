<?php

use Http\models\Airports;

(new Airports())->destroy(['id' => intval($_POST['id'])]);

redirect('/airports');
