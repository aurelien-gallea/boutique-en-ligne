<?php

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Price;
use Classes\Color;
use Classes\Size;
use Classes\Stock;
use Classes\Images;
use Classes\Categories;
use Classes\Prod_cat;

$myProduct = new Products();
$myImg = new Images();
$myPrice = new Price();
$myColor = new Color();
$mySize = new Size();
$myStock = new Stock();
$myCat = new Categories();
$myProdCat = new Prod_cat();

$prod = $myProduct->getProductsByOrderDesc(); 
$img = $myImg->getAll(); 
$price = $myPrice->getAll();
$color = $myColor->getAll();
$colorCount = $myColor->getCountColorByProduct();
$size = $mySize->getAll();
$sizeCount = $mySize->getCountSizeByColor();
$stock = $myStock->getAll();
$categories = $myCat->getAll();
$prod_Cat = $myProdCat->getAll();

// Obtenir le nombre total de couleurs par produit
$colorCounts = array();
foreach ($colorCount as $count) {
    $product_id = $count['product_id'];
    $color_count = $count['color_count'];
    $colorCounts[$product_id] = $color_count;
}

// Obtenir le nombre total de tailles pour chaque produit
$sizeCounts = array();
foreach ($size as $sizeItem) {
    $color_id = $sizeItem['color_id'];
    $product_id = $myColor->getProductIdByColorId($color_id);
    if (!isset($sizeCounts[$product_id])) {
        $sizeCounts[$product_id] = 0;
    }
    $sizeCounts[$product_id]++;
}

// Obtenir le total des quantités pour chaque produit
$quantityCounts = array();
foreach ($size as $sizeItem) {
    $color_id = $sizeItem['color_id'];
    $product_id = $myColor->getProductIdByColorId($color_id);
    $quantity = $myStock->getTotalQuantityBySizeId($sizeItem['id']);
    if (!isset($quantityCounts[$product_id])) {
        $quantityCounts[$product_id] = 0;
    }
    $quantityCounts[$product_id] += $quantity;
}

$arrayJson = [ 
    $myPrice::TABLE_NAME => $price,
    $myImg::TABLE_NAME => $img,
    $myProduct::TABLE_NAME => $prod,
    $myColor::TABLE_NAME => $color, 
    'color_count' => $colorCounts,
    $mySize::TABLE_NAME => $size,
    'size_count' => $sizeCounts,
    'stock_count' => $quantityCounts,
    $myStock::TABLE_NAME => $stock,
    $myCat::TABLE_NAME => $categories,
    $myProdCat::TABLE_NAME => $prod_Cat,
];

print_r(json_encode($arrayJson));
?>