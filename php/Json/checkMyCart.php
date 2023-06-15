<?php
session_start();
$userId = $_SESSION['userId'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Cart;

$myCart = new Cart();

$cart = $myCart->getAllByUserId($userId);
echo count($cart);
foreach ($cart as $key => $value) {
    var_dump($value);
    echo '<br>';
}
// $cartInfo = $myCart->getAllInfoByUserId();






// on boucle à l'aide de l'id du produit et de ses couleurs associés

// $arraySize = [];
// for ($i = 0 ; $i < count($color) ; $i++) {
//     $size = $mySize->getByColorId($color[$i]['id']);
//     array_push($arraySize, ["colorId" => $color[$i]['id'] , "size" => $size]);
// } 

$arrayJson = [ 
    // $myPrice::TABLE_NAME => $price,
    // $myProduct::TABLE_NAME => $prod,
    // $myImage::TABLE_NAME => $img,
    // $myColor::TABLE_NAME => $color, 
    // $mySize::TABLE_NAME => $arraySize,
    $myCart::TABLE_NAME => $cart,
];

echo(json_encode($arrayJson));

?>