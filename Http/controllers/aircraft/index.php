<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$aircraft = $db->query("SELECT * FROM aircraft")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/aircraft/index.view.php');
