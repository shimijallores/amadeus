<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class Seats
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function update(array $attributes): void
    {
        $this->db->query('UPDATE seats SET status = :status, price = :price, customer_name = :customer_name, customer_number = :customer_number, agency_number = :agency_number WHERE id = :id', [
            'id' => $attributes['id'],
            'status' => $attributes['status'],
            'price' => $attributes['price'],
            'customer_name' => $attributes['customer_name'],
            'customer_number' => $attributes['customer_number'],
            'agency_number' => $attributes['agency_number'],
        ]);

        Session::flash('success', 'Seat updated successfully!');
    }
}
