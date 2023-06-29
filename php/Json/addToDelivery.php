<?php
session_start();

$userId = $_SESSION["userId"]; // <----- a changer imperativement avec le $_session

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);

$nameAddress    = $data['nameAddress'];
$firstname      = $data['firstname'];
$lastname       = $data['lastname'];
$address        = $data['address'];
$postalCode     = $data['postalCode'];
$city           = $data['city'];
$country        = $data['country'];
$phone          = $data['phone'];

require_once('../Classes/Delivery.php');

use Classes\Delivery;

$myDelivery = new Delivery();

// condition pour la mise à jour où l'ajout si le nom de l'adresse existe déjà
$row = $myDelivery->avalaibleName($nameAddress, $userId);

if ($row == 0) {
    $myDelivery->addNew($nameAddress, $firstname, $lastname, $address, $postalCode, $city, $country, $phone, $userId);
}

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);
echo json_encode($response);
?>