<?php
$role = "admin"; // faire une condition de vérification

$role !== "admin" ? header("location:index.php") : '';

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

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