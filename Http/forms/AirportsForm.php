<?php

namespace Http\forms;

use Core\Validator;

class AirportsForm extends Form
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

        if (!Validator::string($this->attributes['airport_name'], 5, 100)) {
            $this->errors['airport_name'] = "Enter a valid airport name";
        }

        if (!Validator::string($this->attributes['location_served'], 1, 100)) {
            $this->errors['location_served'] = "Enter a valid location served";
        }

        if (!Validator::string($this->attributes['time'], 1, 100)) {
            $this->errors['time'] = "Enter a valid time zone";
        }

        if (!Validator::string($this->attributes['dst'], 0, 10)) {
            $this->errors['dst'] = "Enter a valid DST value";
        }
    }
}
