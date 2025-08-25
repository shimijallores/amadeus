<?php

use Http\forms\ProductForm;
use Http\models\Products;

$attributes = [
    'name' => $_POST['name'],
    'size' => $_POST['size'],
    'description' => $_POST['description'],
    'category' => $_POST['category'],
    'price' => floatval(str_replace(',', '', $_POST['price'])),
    'quantity' => intval(str_replace(',', '', $_POST['quantity'])),
    'image' => $_FILES['image'] ?? null,
];

ProductForm::validate($attributes);

(new Products())->store($attributes);

redirect('/products');