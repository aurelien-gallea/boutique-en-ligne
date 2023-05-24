<?php
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
$prod = new Products();
echo($prod->getAllById(4));