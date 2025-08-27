<?php

namespace Http\forms;

use Core\Validator;

class RegisterForm extends Form
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

        if (!Validator::string($this->attributes['role'])) {
            $this->errors['role'] = "Enter a role";
        }
    }
}
