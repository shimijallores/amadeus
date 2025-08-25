<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$admin = Session::get('admin');
$heading = 'Products';
$errors = Session::get('errors') ?? false;
$success = Session::get('success') ?? false;

// Fetch All Categories
$categories = $db->query('SELECT * FROM categories')->get();

// Fetch All Products for Display
$products = $db->query('SELECT * FROM products')->get();

require base_path('Http/views/admin/products/index.view.php');
