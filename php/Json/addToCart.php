<?php
session_start();

$userId = $_SESSION["userId"]; // <----- a changer imperativement avec le $_session 
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


spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
use Classes\Cart;

$myCart = new Cart();

// condition pour la mise à jour où l'ajout si le produit existe dans le panier ou non
$row = $myCart->productAlreadyAdded($productId, $colorId, $sizeId, $userId);

if ($row !== 0) {
    $oldCart = $myCart->getQtyByRow($productId, $colorId, $sizeId, $userId);
    $oldQty = $oldCart['quantity'];
    $oldCartId  = $oldCart['id'];

    // on incrémente l'ancienne valeur déjà prensente en base de donnée
    $myCart->updateQuantity($quantity + $oldQty, $oldCartId);
} else {
    
    $myCart->addNew($productId, $colorId, $sizeId, $quantity, $priceId, $userId);
}

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>
