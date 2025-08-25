<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class FlightSchedules
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE flight_schedules SET airline_user_id = :airline_user_id, flight_route_id = :flight_route_id, date_departure = :date_departure, time_departure = :time_departure, date_arrival = :date_arrival, time_arrival = :time_arrival, status = :status WHERE id = :id', [
            'id' => $attributes['id'],
            'airline_user_id' => $attributes['airline_user_id'],
            'flight_route_id' => $attributes['flight_route_id'],
            'date_departure' => $attributes['date_departure'],
            'time_departure' => $attributes['time_departure'],
            'date_arrival' => $attributes['date_arrival'],
            'time_arrival' => $attributes['time_arrival'],
            'status' => $attributes['status'],
        ]);

        Session::flash('success', 'Flight schedule updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM flight_schedules WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Flight schedule deleted successfully!');
    }
}
