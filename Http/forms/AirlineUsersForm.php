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

        if (!Validator::string($this->attributes['user'], 3, 50)) {
            $this->errors['user'] = "Enter a valid username (3-50 characters)";
        }

        if (!Validator::string($this->attributes['password'], 3, 250)) {
            $this->errors['password'] = "Enter a valid password (3-250 characters)";
        }

        if (!Validator::string($this->attributes['type'], 3, 50)) {
            $this->errors['type'] = "Enter a valid type (admin or staff)";
        }

        // Validate type is either admin or staff
        if (!in_array($this->attributes['type'], ['admin', 'staff'])) {
            $this->errors['type'] = "Type must be either 'admin' or 'staff'";
        }
    }
}
