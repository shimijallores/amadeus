<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$airports = $db->query("SELECT * FROM airports")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/airports/index.view.php');
