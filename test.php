<?php

spl_autoload_register(function($classes) {
    require_once('./php/' .$classes. '.php');
});

use Classes\Products;
use Classes\ProductsOptions;
use Classes\Images;
use Classes\Categories;
use Classes\Prod_cat;


$prod = new Products();
// $newOpt = new ProductsOptions();
// $newImage = new Images();
// $newProd_cat = new Prod_cat();

// $newProduct->addNew("Jeans 514", "un super jeans", "100% coton", 20, 135.99);

// var_dump($newProduct->getId());
// $newProduct->updateQuantity(20, $newProduct->getId());

// function getIdProd($id) {
//     require('./php/DB/DBManager.php');
//     $request = $bdd->prepare("SELECT * FROM products WHERE id = ?");
//     $request->execute([$id]);
//     return $request->fetchAll(PDO::FETCH_ASSOC);
// }

// echo($prod->getAllById(4));
// print_r($prod->getAllById(4));

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="test.js"></script>
    <title>Document</title>
</head>
<body>
    
        
</body>
</html> -->

