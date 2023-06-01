<?php
$role = "admin"; // faire une condition de vérification

$role !== "admin" ? header("location:index.php") : '';

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\OrderFinal;
use Classes\Orderdetails;
use Classes\Status;
use Classes\User;
use Classes\Cart;
use Classes\Delivery;

$status = new Status();
$user= new User();
$orderdtl = new Orderdetails();
$orderfinal = new OrderFinal();
$cart = new Cart();
$delivery = new Delivery();


// $user->updatePassword("zoulou", 1);

$arrayJson = [
    $orderfinal::TABLE_NAME => [
        "all" => $orderfinal->getAll(),
        "traitement" => $orderfinal->getByStatus(1),
        "livraison" => $orderfinal->getByStatus(2),
        "termine" => $orderfinal->getByStatus(3)
        ]
];

// peut-être voir pour tout lier à l'utilisateur car un seul panier
$userId= 1;
$cartId = 1;
$orderDetailsId = 1;
// recap de la commande d'un client
$order = [
    "user" =>  $user->getById($userId),
    "cart" => $cart->getUserInfo($userId),
    "orderDetails" => $orderdtl->getByCartId($cartId),
    "delivery" => $delivery->getUserInfo($userId),
    "status" => $orderfinal->getStatusByOrderDetailsId($orderDetailsId),
    "orderfinal" => $orderfinal->getByOrderDetailsId($orderDetailsId)
];
// id_user de orderdetails -> firstname, lastname
// date_commande
// status actuel : name
echo(json_encode($order));