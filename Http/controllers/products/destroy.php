<?php

use Http\models\Products;

(new Products())->destroy(['id' => intval($_POST['id'])]);

redirect('/products');