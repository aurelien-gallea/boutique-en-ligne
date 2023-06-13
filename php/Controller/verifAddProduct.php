<?php

use Classes\Products;
use Classes\Price;
use Classes\Color;
use Classes\Size;
use Classes\Stock;
use Classes\Prod_cat;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

if(isset($_POST['valider'])){
    if(empty($_POST['title'])){
        echo "Le titre est manquant";
    }else if(empty($_POST['description'])){
        echo "La description est manquante";
    }else if(empty($_POST['price'])){
        echo "Le prix du produit n'a pas été choisi.";
    }else if(empty($_POST['color'])){
        echo "La couleur du produit n'a pas été choisi.";
    }else if(empty($_POST['size'])){
        echo "La taille du produit n'a pas été choisi.";
    }else if(empty($_POST['quantity'])){
        echo "La quantité du produit n'a pas été choisi.";
    }else if(empty($_POST['selectCategories'])){
        echo "La catégorie du produit n'a pas été choisi.";
    }else{
        $prod = new Products();
        $newProductId = $prod->addNew($_POST['title'], $_POST['description']);
    }
    
    if($newProductId !== null && $_POST['price'] !== null){
        $price = new Price();
        $price->add($_POST['price'], $newProductId);
    }

    
    if($newProductId !== null && $_POST['color'] !== null && $_POST['size'] !== null && $_POST['quantity'] !== null){
        $colors = $_POST['color'];
        $sizes =$_POST['size'];
        $quantities = $_POST['quantity'];
        
        $count= count($colors);
        
        for($i = 0; $i < $count; $i++){
            $color = $colors[$i];
            $size = $sizes[$i];
            $quantity = $quantities[$i];
            
            $newColor = new Color();
            $newColorId = $newColor->add($color, $newProductId);
            
            $newSize = new Size();
            $newSizeId = $newSize->add($size, $newColorId);
            
            $newQuantity = new Stock();
            $newQuantityId = $newQuantity->add($quantity, $newSizeId);
        }
    }
    
    if($newProductId !== null && $_POST['selectCategories'] !== null){
        $prod_cat = new Prod_cat();
        $prod_cat->addNew($newProductId, $_POST['selectCategories']);
    }

    // if ($newProductId !== null) {
    //     // L'ID du nouvel élément est disponible
    //     echo "Le produit a été créé avec succès. L'ID du produit est : " . $newProductId;
    // } else {
    //     echo "Une erreur s'est produite lors de la création du produit.";
    // }

}