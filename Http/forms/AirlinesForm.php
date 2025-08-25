<?php

namespace Http\forms;

use Core\Validator;

class AirlinesForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes['iata'], 3, 3)) {
            $this->errors['iata'] = "Enter a valid IATA Code";
        }

        if (!Validator::string($this->attributes['icao'], 4, 4)) {
            $this->errors['icao'] = "Enter a valid ICAO Code";
        }

        if (!Validator::string($this->attributes['airline'], 5, 100)) {
            $this->errors['airline'] = "Enter a valid airline";
        }

        if (!Validator::string($this->attributes['callsign'], 1, 100)) {
            $this->errors['callsign'] = "Enter a valid callsign";
        }

        if (!Validator::string($this->attributes['country'], 1, 100)) {
            $this->errors['country'] = "Enter a valid country";
        }

        if (!Validator::string($this->attributes['comments'], 0, 100)) {
            $this->errors['comments'] = "Enter a valid comments";
        }
    }
}
