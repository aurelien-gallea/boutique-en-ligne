<?php
session_start();

$userId = $_SESSION["userId"]; // <----- a changer imperativement avec le $_session

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);

$deliveryFullAddress  = $data['deliveryFullAddress'];
$carriersDetails      = $data['carriersDetails'];
$carriers_price       = $data['carriers_price'];
$product_ids          = $data['products_ids'];
$color_ids            = $data['color_ids'];
$size_ids             = $data['size_ids']; 
$quantity             = $data['quantity']; 
$total_amount         = $data['total_amount']; 
 
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
use Classes\Orderdetails;

$myOrderdetails = new Orderdetails();

// condition pour la mise à jour ou l'ajout si le nom de l'adresse existe déjà
$row = $myOrderdetails->alreadyAdded($userId);

if ($row == 0) {
    $myOrderdetails->addNew($deliveryFullAddress, $carriersDetails, $carriers_price,$product_ids,$color_ids,$size_ids,$quantity,$total_amount, $userId);
} else {
    $myOrderdetails->updateDeliveryFullAddress($deliveryFullAddress, $userId);
    $myOrderdetails->updateCarriersDetails($carriersDetails, $userId);
    $myOrderdetails->updateCarriers_price($carriers_price, $userId);
    $myOrderdetails->updateProduct_ids($product_ids, $userId);
    $myOrderdetails->updateColor_ids($color_ids, $userId);
    $myOrderdetails->updateSize_ids($size_ids, $userId);
    $myOrderdetails->updateQuantity($quantity, $userId);
    $myOrderdetails->updateTotal_amount($total_amount, $userId);

}

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>