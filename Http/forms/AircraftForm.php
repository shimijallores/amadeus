<?php

namespace Http\forms;

use Core\Validator;

class AircraftForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes['iata'], 2, 3)) {
            $this->errors['iata'] = "Enter a valid IATA Code";
        }

        if (!Validator::string($this->attributes['icao'], 4, 4)) {
            $this->errors['icao'] = "Enter a valid ICAO Code";
        }

        if (!Validator::string($this->attributes['model'], 5, 100)) {
            $this->errors['model'] = "Enter a valid aircraft";
        }
    }
}
