<?php

use Core\Authenticator;
use Http\Forms\LoginForm;
use Http\forms\RegisterForm;

$form = RegisterForm::validate($attributes = [
    'username' => strtolower($_POST['username']),
    'password' => $_POST['password'],
    'role' => $_POST['role'],
]);

$signed_in = (new Authenticator())->register_attempt($attributes);

if (!$signed_in) {
    $form->error('body', 'Invalid Credentials.')->throw();
}

redirect('/airlines');
