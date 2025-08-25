<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class Airports
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE airports SET iata = :iata, icao = :icao, airport_name = :airport_name, location_served = :location_served, time = :time, dst = :dst WHERE id = :id', [
            'iata' => $attributes['iata'],
            'icao' => $attributes['icao'],
            'airport_name' => $attributes['airport_name'],
            'location_served' => $attributes['location_served'],
            'time' => $attributes['time'],
            'dst' => $attributes['dst'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Airport updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM airports WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Airport deleted successfully!');
    }
}
