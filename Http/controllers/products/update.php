<?php

use Http\forms\ProductForm;
use Http\models\Products;

$attributes = [
    'id' => intval($_POST['id']),
    'method' => 'PATCH',
    'name' => $_POST['name'],
    'size' => $_POST['size'],
    'description' => $_POST['description'],
    'category' => $_POST['category'],
    'price' => floatval(str_replace(',', '', $_POST['price'])),
    'quantity' => intval(str_replace(',', '', $_POST['quantity'])),
    'image' => $_FILES['image'] ?? null,
];

ProductForm::validate($attributes);

(new Products())->update($attributes);

redirect('/products');