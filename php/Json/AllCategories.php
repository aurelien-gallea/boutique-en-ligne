<?php

use Classes\Categories;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$cat = new Categories();
print_r($cat->getAll());
?>