<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$airlines = $db->query("SELECT * FROM airlines")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/airlines/index.view.php');
