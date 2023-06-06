<?php
// Récupérer la variable envoyée depuis le fichier JavaScript
$variable = $_POST['variable'];

// Effectuer vos opérations PHP en utilisant la variable

// Par exemple, renvoyer une réponse JSON contenant la variable
$response = array('message' => 'La variable a été reçue : ' . $variable);

header('Content-Type: application/json');
echo json_encode($response);
spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Stock;
use Classes\Color;

$myProduct = new Products();
$myStock   = new Stock();
$myColor = new Color();

// probleme récuperer l'id du produit 
$prod = $myProduct->getAllById($_POST['variable']);
$stock = $myStock->getByProductId($_POST['variable']);
$color = $myColor->getAll();

$arrayJson = [ 
    $myStock::TABLE_NAME => $stock,
    $myProduct::TABLE_NAME => $prod,
    $myColor::TABLE_NAME => $color  
];

echo(json_encode($arrayJson));

?>