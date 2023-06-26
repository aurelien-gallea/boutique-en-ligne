<?php
session_start();
$userId = $_SESSION["userId"];

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
use classes\Orderdetails;
$myCart = new Cart();
$myOrderdetails = new Orderdetails();

$row = $myCart->productAlreadyAdded($productId, $colorId, $sizeId, $userId);
$rowOrder = $myOrderdetails->alreadyAdded($userId);
if ($rowOrder !== 0) $myOrderdetails->deleteRow($userId);
if ($row !== 0) {
    $oldCart = $myCart->getQtyByRow($productId, $colorId, $sizeId, $userId);
    $oldQty = $oldCart['quantity'];
    $oldCartId  = $oldCart['id'];

    // on incrémente l'ancienne valeur déjà présente en base de données
    $myCart->updateQuantity($quantity + $oldQty, $oldCartId);
} else {
    
    $myCart->addNew($productId, $colorId, $sizeId, $quantity, $priceId, $userId);
}

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>