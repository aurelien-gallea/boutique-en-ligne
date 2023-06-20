<?php

use Classes\Categories;
use Classes\Prod_cat;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$cat = new Categories();
$prod_cat = new Prod_cat();

$categories = $cat->getAll();
$prod_count = $prod_cat->getProductCountByCategories();

$arrayJson = [
    $cat::TABLE_NAME => $categories,
    'product_count' => $prod_count
];

print_r(json_encode($arrayJson));
?>