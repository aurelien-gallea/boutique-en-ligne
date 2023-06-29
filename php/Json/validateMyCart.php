<?php
session_start();

$userId = $_SESSION["userId"]; // <----- a changer imperativement avec le $_session 

require_once('../Classes/Cart.php');
require_once('../Classes/Orderdetails.php');

use Classes\Cart;
use Classes\Orderdetails;

// Récupérer les données envoyées depuis la requête
$data = json_decode(file_get_contents('php://input'), true);

$myCart = new Cart();
$myOrderdetails = new Orderdetails();

    foreach ($data as $key => $element) {
        
        $cartId = $element['cart_id'];
        $productId = $element['product_id'];
        $colorId = $element['color_id'];
        $sizeId = $element['size_id'];
        $quantity = $element['quantity'];
        $priceId = $element['price_id'];
        
        $cart = $myCart->getById($cartId); // <-- ici on récupère les valeurs de la bdd qu'on va comparer aux notres
        $rowOrder = $myOrderdetails->alreadyAdded($userId);
        if ($rowOrder !== 0) $myOrderdetails->deleteRow($userId);
        // condition pour update
        if ($cart['id'] === $cartId && $cart['product_id'] === $productId) {
            
            if ($quantity === 0) {

                $myCart->deleteRow($cartId);
            } else {

                if ($cart['quantity'] != $quantity) $myCart->updateQuantity($quantity, $cartId);
                if ($cart['size_id'] != $sizeId) $myCart->updateSize_id($sizeId, $cartId);
                
                // si le panier est changé on détruit la ligne orderdetails
            }
            
        }
    }


// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>
