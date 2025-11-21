<?php

namespace Http\forms;

use Core\Validator;

class AirlineUsersForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::number($this->attributes['airline_id'])) {
            $this->errors['airline_id'] = "Enter a valid airline ID";
        }

        if (!Validator::string($this->attributes['username'], 1, 100)) {
            $this->errors['username'] = "Enter a valid username (3-50 characters)";
        }

        // Validate role is either admin or staff
        if (!in_array($this->attributes['role'], ['admin', 'staff'])) {
            $this->errors['role'] = "Type must be either 'admin' or 'staff'";
        }
    }
}
