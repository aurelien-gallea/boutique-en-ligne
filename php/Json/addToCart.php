<?php
session_start();

$userId= 1; // <----- a changer imperativement avec le $_session 
// Récupérer les données envoyées depuis la requête
$data = json_decode(file_get_contents('php://input'), true);

$productId = $data['product_id'];
$colorName = $data['color'];
$colorId = $data['color_id'];
$sizeName = $data['size'];
$sizeId = $data['size_id'];
$quantity = $data['quantity'];
$price = $data['price'];
$priceId = $data['price_id'];

// Effectuer ici votre logique d'ajout au panier
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
use Classes\Cart;

$myCart = new Cart();
$myCart->addNew($productId, $colorId, $sizeId, $quantity, $priceId, $userId);

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>
