<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

// Join airline_users with airlines to get airline name
$airline_users = $db->query("
    SELECT au.*, a.airline as airline_name 
    FROM airline_users au 
    LEFT JOIN airlines a ON au.airline_id = a.id
")->get();

// Get all airlines for the dropdown in the update modal
$airlines = $db->query("SELECT id, airline FROM airlines")->get();

$errors = Session::get("errors") ?? false;

require base_path('Http/views/airline_users/index.view.php');
