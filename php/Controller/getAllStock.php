<?php
$role = "admin"; // faire une condition de vérification

$role !== "admin" ? header("location:index.php") : '';

require_once('../Classes/Stock.php');

use Classes\Stock;

$stock = new Stock();

$arrayJson = [
    $stock::TABLE_NAME => [
        "all" => $stock->getAll(),
        "limited" => $stock->getAlertLimited(20),
        "outOfStock" => $stock->getAlertOutOfStock()
        ]
];

echo(json_encode($arrayJson));