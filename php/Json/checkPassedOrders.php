<?php
session_start();
$userId = $_SESSION['userId'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Orderfinal;

$myOrders = new Orderfinal();

// récupération de toutes les lignes de paniers de l'utilisateur  
$AllMyOrders = $myOrders->getAllByUserId($userId); // -> return un fetchAll(PDO::FETCH_ASSOC)

echo(json_encode($AllMyOrders));

?>