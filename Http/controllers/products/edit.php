<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$admin = Session::get('admin');
$heading = 'Edit Products';
$errors = Session::get('errors') ?? [];

// Fetch the product for editing
$product = $db->query('SELECT * FROM products WHERE id = :id', ['id' => $_GET['id']])->find_or_fail();

// Fetch all categories for the dropdown
$categories = $db->query('SELECT * FROM categories')->get();

require base_path('Http/views/admin/products/edit.view.php');
