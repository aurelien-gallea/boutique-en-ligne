<?php

use Classes\Products;
use Classes\Prod_cat;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

if(isset($_POST['valider'])){
    if(empty($_POST['title'])){
        echo "Le titre est manquant";
    }else if(empty($_POST['description'])){
        echo "La description est manquante";
    }else if(empty($_POST['subDesc'])){
        echo "La sous-description est manquante";
    }else if(empty($_POST['quantity'])){
        echo "La quantitée est manquante";
    }else if(empty($_POST['price'])){
        echo "Le prix est manquant";
    }else if(empty($_POST['prodOption'])){
        echo "La catégorie du produit n'a pas été choisi.";
    }else{
        $prod = new Products();
        $newProductId = $prod->addNew($_POST['title'], $_POST['description'], $_POST['subDesc'], $_POST['quantity'], $_POST['price']);
    }

    if($newProductId !== null && $_POST['prodOption'] !== null){
        $prod_cat = new Prod_cat();
        $prod_cat->addNew($newProductId, $_POST['prodOption']);
    }else{
        echo "une erreur est survenue!";
    }

    // if ($newProductId !== null) {
    //     // L'ID du nouvel élément est disponible
    //     echo "Le produit a été créé avec succès. L'ID du produit est : " . $newProductId;
    // } else {
    //     echo "Une erreur s'est produite lors de la création du produit.";
    // }

}