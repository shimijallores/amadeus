<?php

use Core\Session;

$errors = Session::get('errors') ?? false;

require base_path('Http/views/authentication/register.view.php');