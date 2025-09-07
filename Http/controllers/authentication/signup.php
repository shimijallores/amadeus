<?php

use Core\Authenticator;
use Http\forms\RegisterForm;


$form = RegisterForm::validate($attributes = [
    'username' => strtolower($_POST['username']),
    'password' => $_POST['password'],
    'role' => $_POST['role'],
    // For staff only
    'airline_id' => $_POST['airline_id']
]);

$signed_in = (new Authenticator())->register_attempt($attributes);

if (!$signed_in) {
    $form->error('body', 'Invalid Credentials.')->throw();
}

redirect('/airlines');
