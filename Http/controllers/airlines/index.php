<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = $_SESSION['user'];

$airlines = [];
if ($user['role'] === 'staff') {
  $airlines = $db->query("SELECT * FROM airlines where id = :id", ['id' => $user['airline_id']])->get();
} else {
  $airlines = $db->query("SELECT * FROM airlines")->get();
}

$errors = Session::get("errors") ?? false;

require base_path('Http/views/airlines/index.view.php');
