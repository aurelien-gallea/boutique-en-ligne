<?php

require_once("./php/Classes/ProductsOptions.php");
use Classes\ProductsOptions;

$option = new ProductsOptions();
$option->deleteRow(3);
var_dump($option->getAll()->fetchAll(PDO::FETCH_ASSOC));
$option->updateQuantity(3,1);
$option->updateValue("vert",1);
$option->updatePrice(7,1);
echo $option->findIdWith("vert", "name");
echo "<br>";


