<?php
    session_start();

    use Classes\Categories;
    use Classes\Prod_cat;

    spl_autoload_register(function($classes) {
        require_once('../' .$classes. '.php');
    });

    $prodCat = new Prod_cat();
    $cat = new Categories();

    $categories = $cat->getAll();
    $prod_cat = $prodCat->getAllCategoriesByProductId($_SESSION['productID']);
    
    $arrayJson = [
        $cat::TABLE_NAME => $categories,
        $prodCat::TABLE_NAME => $prod_cat,
    ];

    echo(json_encode($arrayJson));