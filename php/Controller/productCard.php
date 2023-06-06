<?php
session_start();

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Stock;
use Classes\Images;
use Classes\Color;
use Classes\Size;

$myProduct = new Products();
$myStock   = new Stock();
$myColor = new Color();
$myImage = new Images();



// probleme récuperer l'id du produit 
$prod = $myProduct->getAllById($_SESSION['productID']);
$stock = $myStock->getAllInfosByProductId($_SESSION['productID']);
$img = $myImage->getAllByProductId($_SESSION['productID']);

$arrayJson = [ 
    $myStock::TABLE_NAME => $stock,
    $myProduct::TABLE_NAME => $prod,
    $myImage::TABLE_NAME => $img 
];

echo(json_encode($arrayJson));

?>