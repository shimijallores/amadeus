<?php

use Http\models\Aircraft;

(new Aircraft())->destroy(['id' => intval($_POST['id'])]);

redirect('/aircraft');
