<?php

use Core\Session;

$errors = Session::get('errors') ?? [];
$username = old('username');

require base_path('Http/views/admin/auth/login.view.php');
