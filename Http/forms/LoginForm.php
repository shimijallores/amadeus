<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
        if (!Validator::string($this->attributes['password'])) {
            $this->errors['password'] = "Enter a valid password";
        }

        if (!Validator::string($this->attributes['username'])) {
            $this->errors['username'] = "Enter a username";
        }
    }
}
