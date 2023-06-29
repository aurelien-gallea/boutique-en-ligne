<?php
session_start();
$userId = $_SESSION['userId'];

require_once('../Classes/Orderfinal.php');

use Classes\Orderfinal;

$myOrders = new Orderfinal();

// récupération de toutes les lignes de paniers de l'utilisateur  
$AllMyOrders = $myOrders->getAllByUserId($userId); // -> return un fetchAll(PDO::FETCH_ASSOC)

echo(json_encode($AllMyOrders));

?>