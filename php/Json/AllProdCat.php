<?php 

use Classes\Prod_cat;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$prod_cat = new Prod_cat();
print_r($prod_cat->getAll());
?>