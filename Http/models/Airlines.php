<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class Airlines
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function store(array $attributes): void
    {
        // Insert into the database
        $this->db->query("INSERT INTO airlines (iata, icao, airline, callsign, country, comments) VALUES (:iata, :icao, :airline, :callsign, :country, :comments)", [
            'iata' => $attributes['iata'],
            'icao' => $attributes['icao'],
            'airline' => $attributes['airline'],
            'callsign' => $attributes['callsign'],
            'country' => $attributes['country'],
            'comments' => $attributes['comments'],
        ]);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE airlines SET iata = :iata, icao = :icao, airline = :airline,  callsign = :callsign,  country = :country,  comments = :comments  WHERE id = :id', [
            'iata' => $attributes['iata'],
            'airline' => $attributes['airline'],
            'callsign' => $attributes['callsign'],
            'country' => $attributes['country'],
            'comments' => $attributes['comments'],
            'icao' => $attributes['icao'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Airline updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM airlines WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Airline deleted successfully!');
    }
}