<?php

use Classes\Categories;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$cat = new Categories();
$jsonData = json_encode($cat->getAll());
print_r($jsonData);
?>