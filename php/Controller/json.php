<?php
$role = "admin";

$role !== "admin" ? header("location:index.php") : '';

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
use Classes\User;
use Classes\Products;
use Classes\Cart;
use Classes\Delivery;
use Classes\ProductsOptions;



$users = new User();
$prod = new Products();
$cart = new Cart();
$delivery = new Delivery();
$prodOpt = new ProductsOptions();

$allCart = $cart->getAll();
$allProd = $prod->getAll();
$id= 1;

$arrayJson = [ 
    $users::TABLE_NAME => $users->getAll(),
    $prod::TABLE_NAME => $allProd,
    $prodOpt::TABLE_NAME => $prodOpt->getAll(), 
    $cart::TABLE_NAME => $allCart,
    $cart::TABLE_NAME.".userId" => $cart->getAllByUserId($id), 
    $delivery::TABLE_NAME.".userId" => $delivery->getAllByUserId($id),
    $prodOpt::TABLE_NAME.".productId" => $prodOpt->getAllByProductId($id),

];
echo(json_encode($arrayJson));