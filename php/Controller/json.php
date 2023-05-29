<?php
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Cart;
use Classes\Delivery;
use Classes\ProductsOptions;

$prod = new Products();
$cart = new Cart();
$delivery = new Delivery();
$prodOpt = new ProductsOptions();

$allCart = $cart->getAll();
$allProd = $prod->getAll();
$id= 1;
$arrayJson = [ 

    $prod::TABLE_NAME => $allProd,
    $prodOpt::TABLE_NAME => $prodOpt->getAll(), 
    $cart::TABLE_NAME => $allCart,
    $cart::TABLE_NAME.".userId" => $cart->getAllByUserId(1), 
    $delivery::TABLE_NAME.".userId" => $delivery->getAllByUserId(1),
    $prodOpt::TABLE_NAME.".productId" => $prodOpt->getAllByProductId(1),

];
echo(json_encode($arrayJson));