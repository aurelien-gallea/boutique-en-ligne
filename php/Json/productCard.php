<?php
session_start();

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Images;
use Classes\Color;
use Classes\Size;
use Classes\Price;

$myProduct = new Products();
$myPrice = new Price();
$myColor = new Color();
$myImage = new Images();
$mySize = new Size();


// probleme récuperer l'id du produit 
$prod = $myProduct->getAllById($_SESSION['productID']);
$price = $myPrice->getAllByProductId($_SESSION['productID']);
$img = $myImage->getAllByProductId($_SESSION['productID']);
$color = $myColor->getAllByProductId($_SESSION['productID']);

// on boucle à l'aide de l'id du produit et de ses couleurs associés
$arraySize = [];
for ($i = 0 ; $i < count($color) ; $i++) {
    $size = $mySize->getByColorId($color[$i]['id']);
    array_push($arraySize, ["colorId" => $color[$i]['id'] , "size" => $size]);
} 
$arrayJson = [ 
    $myPrice::TABLE_NAME => $price,
    $myProduct::TABLE_NAME => $prod,
    $myImage::TABLE_NAME => $img,
    $myColor::TABLE_NAME => $color, 
    $mySize::TABLE_NAME => $arraySize,
];

echo(json_encode($arrayJson));

?>