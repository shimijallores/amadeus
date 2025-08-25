<?php

namespace Http\forms;

use Core\Validator;

class FlightRoutesForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::number($this->attributes['airline_id'])) {
            $this->errors['airline_id'] = "Enter a valid airline ID";
        }

        if (!Validator::number($this->attributes['origin_airport_id'])) {
            $this->errors['origin_airport_id'] = "Enter a valid origin airport ID";
        }

        if (!Validator::number($this->attributes['destination_airport_id'])) {
            $this->errors['destination_airport_id'] = "Enter a valid destination airport ID";
        }

        if (!Validator::number($this->attributes['aircraft_id'])) {
            $this->errors['aircraft_id'] = "Enter a valid aircraft ID";
        }

        // Validate round_trip is 0 or 1
        if (!in_array($this->attributes['round_trip'], [0, 1])) {
            $this->errors['round_trip'] = "Round trip must be Yes or No";
        }

        // Validate origin and destination are not the same
        if ($this->attributes['origin_airport_id'] === $this->attributes['destination_airport_id']) {
            $this->errors['destination_airport_id'] = "Destination airport must be different from origin airport";
        }
    }
}
