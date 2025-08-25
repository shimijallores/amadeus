<?php

use Http\models\Airlines;

(new Airlines())->destroy(['id' => intval($_POST['id'])]);

redirect('/');