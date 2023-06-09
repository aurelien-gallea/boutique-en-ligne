<?php

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;

$prod = new Products();
$jsonData = json_encode($prod->getAll());
print_r($jsonData);
?>