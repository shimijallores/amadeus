<?php

use Core\Authenticator;
use Http\Forms\LoginForm;


$form = LoginForm::validate($attributes = [
    'username' => strtolower($_POST['username']),
    'password' => $_POST['password'],
    'role' => $_POST['role'],
]);

$signed_in = (new Authenticator())->login_attempt($attributes);

if (!$signed_in) {
    $form->error('body', 'Invalid Credentials.')->throw();
}

redirect('/airlines');
