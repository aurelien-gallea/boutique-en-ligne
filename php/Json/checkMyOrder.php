<?php
session_start();
$userId = $_SESSION['userId'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Cart;
use Classes\Orderdetails;


$myCart = new Cart();
$myOrderDetails = new OrderDetails();

// récupération de toutes les lignes de paniers de l'utilisateur  
$cart = $myCart->getAllByUserId($userId); // -> return un fetchAll(PDO::FETCH_ASSOC)
// on boucle sur chaque ligne(index) du tableau associatif du panier de l'utilisateur pour en extraire les valeurs et les récupérer
// pour les passer en paramètre à notre prochaine fonctions qui récupèrera les infos grace aux multiples INNER JOIN liés aux id correspondant

$arrayCart = []; // on remplit le tableau à l'aide de la boucle pour l'echo en json 

foreach ($cart as $key => $value) {
    
    $cartRow = $myCart->getRowAllInfosByUserId($value['product_id'], $value['color_id'], $value['size_id'], $value['price_id'], $value['quantity'], $userId);
    
    array_push($arrayCart, $cartRow);
        
}

$orderDetails = $myOrderDetails->getByUserId($userId);

// notre json disponible pour le front
$arrayJson = [ 
    
    $myCart::TABLE_NAME => $arrayCart,
    $myOrderDetails::TABLE_NAME => $orderDetails
];

echo(json_encode($arrayJson));

?>