<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class FlightRoutes
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE flight_routes SET airline_id = :airline_id, origin_airport_id = :origin_airport_id, destination_airport_id = :destination_airport_id, round_trip = :round_trip, aircraft_id = :aircraft_id WHERE id = :id', [
            'airline_id' => $attributes['airline_id'],
            'origin_airport_id' => $attributes['origin_airport_id'],
            'destination_airport_id' => $attributes['destination_airport_id'],
            'round_trip' => $attributes['round_trip'],
            'aircraft_id' => $attributes['aircraft_id'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Flight route updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM flight_routes WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Flight route deleted successfully!');
    }
}
