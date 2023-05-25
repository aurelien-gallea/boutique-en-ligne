<?php

use Classes\Products;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$prod = new Products();
print_r($prod->getAll());

?>