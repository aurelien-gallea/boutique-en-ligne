<?php

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
use Classes\Stock;
use Classes\Products;





$prod = new Products();
$stock = new Stock();


$allProd = $prod->getAll();
$allStock = $stock->getallWithImagesInfo();


$arrayJson = [ 
    $stock::TABLE_NAME => $allStock,
    $prod::TABLE_NAME => $allProd,
   

];
echo(json_encode($arrayJson));