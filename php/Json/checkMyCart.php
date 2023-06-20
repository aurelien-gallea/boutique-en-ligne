<?php
session_start();
$userId = $_SESSION['userId'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Cart;
use Classes\Size;
$myCart = new Cart();
$mySize = new Size();

// récupération de toutes les lignes de paniers de l'utilisateur  
$cart = $myCart->getAllByUserId($userId); // -> return un fetchAll(PDO::FETCH_ASSOC)
// on boucle sur chaque ligne(index) du tableau associatif du panier de l'utilisateur pour en extraire les valeurs et les récupérer
// pour les passer en paramètre à notre prochaine fonctions qui récupèrera les infos grace aux multiples INNER JOIN liés aux id correspondant

$arrayCart = []; // on remplit le tableau à l'aide de la boucle pour l'echo en json 
$arraySize = [];
foreach ($cart as $key => $value) {
    
    $cartRow = $myCart->getRowAllInfosByUserId($value['product_id'], $value['color_id'], $value['size_id'], $value['price_id'], $value['quantity'], $userId);
    $size = $mySize->getByColorId($value['color_id']);
    array_push($arrayCart, $cartRow);
    array_push($arraySize, $size);
    
}

// notre json disponible pour le front
$arrayJson = [ 
    
    $myCart::TABLE_NAME => $arrayCart,
    $mySize::TABLE_NAME => $arraySize
];

echo(json_encode($arrayJson));

?>