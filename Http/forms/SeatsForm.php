<?php

namespace Http\forms;

use Core\Validator;

class SeatsForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes['status'], 1, 50)) {
            $this->error('status', 'Status is required.');
        }

        if (!Validator::number($this->attributes['price'], 1)) {
            $this->error('price', 'Price is required.');
        }
    }
}
