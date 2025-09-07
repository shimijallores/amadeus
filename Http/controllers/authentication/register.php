<?php

use Core\App;
use Core\Database;
use Core\Session;

$errors = Session::get('errors') ?? false;

$db = App::resolve(Database::class);

$airlines = $db->query("SELECT * FROM airlines")->get();

require base_path('Http/views/authentication/register.view.php');
