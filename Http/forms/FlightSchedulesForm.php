<?php

namespace Http\forms;

use Core\Validator;

class FlightSchedulesForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes['airline_user_id'], 1)) {
            $this->error('airline_user_id', 'Airline User is required.');
        }

        if (!Validator::string($this->attributes['flight_route_id'], 1)) {
            $this->error('flight_route_id', 'Flight Route is required.');
        }

        if (!Validator::string($this->attributes['date_departure'], 1, 20)) {
            $this->error('date_departure', 'Departure Date is required.');
        }

        if (!Validator::string($this->attributes['time_departure'], 1, 10)) {
            $this->error('time_departure', 'Departure Time is required.');
        }

        if (!Validator::string($this->attributes['date_arrival'], 1, 20)) {
            $this->error('date_arrival', 'Arrival Date is required.');
        }

        if (!Validator::string($this->attributes['time_arrival'], 1, 10)) {
            $this->error('time_arrival', 'Arrival Time is required.');
        }

        if (!Validator::string($this->attributes['status'], 1, 50)) {
            $this->error('status', 'Status is required.');
        }
    }
}
