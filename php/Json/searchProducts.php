<?php
session_start();

require_once('../Classes/Products.php');

use Classes\Products;

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);

$inputValue = $data['name'];

$myProducts = new Products();

$mySearch = $myProducts->getSearchLike($inputValue);

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array($mySearch);
echo json_encode($response);
?>
