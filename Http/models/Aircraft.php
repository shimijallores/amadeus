<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class Aircraft
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function store(array $attributes): void
    {
        $this->db->query('INSERT INTO aircraft (iata, icao, model) VALUES (:iata, :icao, :model)', [
            'iata' => $attributes['iata'],
            'icao' => $attributes['icao'],
            'model' => $attributes['model'],
        ]);

        Session::flash('success', 'Aircraft updated successfully!');
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE aircraft SET iata = :iata, icao = :icao, model = :model WHERE id = :id', [
            'iata' => $attributes['iata'],
            'icao' => $attributes['icao'],
            'model' => $attributes['model'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Aircraft updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM aircraft WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Aircraft deleted successfully!');
    }

    public function update_layout(array $attributes): void
    {
        // Update aircraft table
        $this->db->query('UPDATE aircraft SET layout = :layout, `rows` = :rows, `columns` = :columns, seats_f = :seats_f, seats_c = :seats_c, seats_y = :seats_y WHERE id = :id', [
            'layout' => $attributes['layout'],
            'rows' => $attributes['rows'],
            'columns' => $attributes['columns'],
            'seats_f' => $attributes['seats_f'],
            'seats_c' => $attributes['seats_c'],
            'seats_y' => $attributes['seats_y'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Aircraft layout updated successfully!');
    }
}
