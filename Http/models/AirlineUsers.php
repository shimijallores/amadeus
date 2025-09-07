<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class AirlineUsers
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE airline_users SET airline_id = :airline_id, user = :user, role = :role WHERE id = :id', [
            'airline_id' => $attributes['airline_id'],
            'user' => $attributes['user'],
            'role' => $attributes['role'],
            'id' => $attributes['id'],
        ]);

        Session::flash('success', 'Airline user updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->db->query('DELETE FROM airline_users WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Airline user deleted successfully!');
    }
}
