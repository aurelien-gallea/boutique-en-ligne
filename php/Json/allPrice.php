<?php

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Price;

require('../DB/DBManager.php');
$request = $bdd->prepare("SELECT p.id, p.name, pr.price
FROM products p
JOIN price pr ON p.id = pr.product_id;");

$request->execute();
$response = $request->fetchAll(PDO::FETCH_CLASS);
$newJson = json_encode($response);
print_r($newJson);
// $price = new Price();


// $jsonPrice = json_encode($price->getAll());
// print_r($jsonPrice);
?>