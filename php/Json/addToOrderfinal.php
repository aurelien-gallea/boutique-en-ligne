<?php
session_start();

$userId = $_SESSION["userId"]; // <----- a changer imperativement avec le $_session

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);
 
$payement_status      = $data['payement_status'];
 
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});
;
use Classes\Orderfinal;
use Classes\Cart;
use Classes\Orderdetails;

$myOrderfinal = new Orderfinal();
$myCart = new Cart();
$myOrderdetails = new Orderdetails();
$result = $myOrderdetails->getByUserId($userId);
var_dump($result);
// si la comande existe existe alors on peut continuer le tunnel d'achat
if ($result) {

    $deliveryFullAddress  = $result['deliveryFullAddress'];
    $carriersDetails      = $result['carriersDetails'];
    $carriers_price       = $result['carriers_price'];
    $product_ids          = $result['product_ids'];
    $color_ids            = $result['color_ids'];
    $size_ids             = $result['size_ids'];
    $product_names        = $result['product_names'];
    $color_names          = $result['color_names'];
    $size_names           = $result['size_names'];
    $price_values         = $result['price_values'];
    $quantity             = $result['quantity'];
    $total_amount         = $result['total_amount'];

    $orderSuccess = $myOrderfinal->addNew($deliveryFullAddress, $carriersDetails, $carriers_price, $product_ids, $color_ids, $size_ids,$product_names,$color_names,$size_names,$price_values, $quantity, $total_amount, $payement_status, $userId);
    // si la table orderfinal est rempli alors on vide les tables cart et orderdetails qui contiennent cet id_user
    if ($orderSuccess) {
        $myCart->deleteRowByUserId($userId);
        $myOrderdetails->deleteRowByUserId($userId);
    }
}

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>