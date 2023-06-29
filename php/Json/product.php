<?php
session_start();

require_once('../Classes/Products.php');
require_once('../Classes/Images.php');
require_once('../Classes/Color.php');
require_once('../Classes/Size.php');
require_once('../Classes/Price.php');
require_once('../Classes/Stock.php');

use Classes\Products;
use Classes\Images;
use Classes\Color;
use Classes\Size;
use Classes\Price;
use Classes\Stock;

$myProduct = new Products();
$myPrice = new Price();
$myColor = new Color();
$myImage = new Images();
$mySize = new Size();
$myStock =new Stock();

// probleme récuperer l'id du produit 
$prod = $myProduct->getAllById($_SESSION['productID']);
$price = $myPrice->getAllByProductId($_SESSION['productID']);
$img = $myImage->getAllByProductId($_SESSION['productID']);
$color = $myColor->getAllByProductId($_SESSION['productID']);

// on boucle à l'aide de l'id du produit et de ses couleurs associés
$arraySize = [];
$arrayStock = [];
for ($i = 0 ; $i < count($color) ; $i++) {
    $size = $mySize->getByColorId($color[$i]['id']);
    array_push($arraySize, ["colorId" => $color[$i]['id'] , "size" => $size]);
    for($j = 0; $j < count($size) ; $j++) {
        $stock = $myStock->getBySizeId($size[$j]['id']);
        array_push($arrayStock, ["sizeId" => $size[$j]['id'] , "stock" => $stock]);
    } 
}

$arrayJson = [ 
    $myPrice::TABLE_NAME => $price,
    $myProduct::TABLE_NAME => $prod,
    $myImage::TABLE_NAME => $img,
    $myColor::TABLE_NAME => $color, 
    $mySize::TABLE_NAME => $arraySize,
    $myStock::TABLE_NAME => $arrayStock,
];

echo(json_encode($arrayJson));

?>