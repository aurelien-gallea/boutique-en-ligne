<?php

require_once('../Classes/Products.php');
require_once('../Classes/Images.php');
require_once('../Classes/Price.php');
require_once('../Classes/Color.php');
require_once('../Classes/Size.php');
require_once('../Classes/Stock.php');
require_once('../Classes/Prod_cat.php');

use Classes\Products;
use Classes\Images;
use Classes\Price;
use Classes\Color;
use Classes\Size;
use Classes\Stock;
use Classes\Prod_cat;

if(isset($_POST['valider'])){
    if(empty($_POST['title'])){
        echo "Le titre est manquant";
    }else if(empty($_POST['description'])){
        echo "La description est manquante";
    }else if(empty($_FILES['images'])){
        echo "le média est manquant";
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
        $newProductId = $prod->add($_POST['title'], $_POST['description']);
    }

    if($newProductId !== null && $_FILES['images'] !== null){
        $images = $_FILES['images'];

        $count = count($images['name']);

        for($i = 0; $i < $count; $i++){
            $image = $images['name'][$i];
            $fichiertmp = $images['tmp_name'][$i];

            $url = $_SERVER['SCRIPT_FILENAME'];
            $path = parse_url($url, PHP_URL_PATH);
            $directory = explode('/', $path)[3];
            
            $dest = $_SERVER['DOCUMENT_ROOT'].'/'.$directory.'/Public/img/product/'.$image;
            
            if(move_uploaded_file($fichiertmp, $dest)){
                $img = new Images();
                $newImg = $img->add($image, $newProductId);
            };
        }
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

            $colorInstance = new Color();
            $existingColor = $colorInstance->findByProductAndColor($newProductId, $color);
            
            if ($existingColor) {
                $newColorId = $existingColor->getId();
            } else {
                $newColor = new Color();
                $newColorId = $newColor->add($color, $newProductId);
            }
            
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

    $url = $_SERVER['SCRIPT_FILENAME'];
    $path = parse_url($url, PHP_URL_PATH);
    $directory = explode('/', $path)[3];

    $destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

    header('location: '.$destination.'/admin/iframe/allProducts.php');

    // if ($newProductId !== null) {
    //     // L'ID du nouvel élément est disponible
    //     echo "Le produit a été créé avec succès. L'ID du produit est : " . $newProductId;
    // } else {
    //     echo "Une erreur s'est produite lors de la création du produit.";
    // }

}