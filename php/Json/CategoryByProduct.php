<?php
    session_start();

    require_once('../Classes/Categories.php');
    require_once('../Classes/Prod_cat.php');

    use Classes\Categories;
    use Classes\Prod_cat;

    $prodCat = new Prod_cat();
    $cat = new Categories();

    $categories = $cat->getAll();
    $prod_cat = $prodCat->getAllCategoriesByProductId($_SESSION['productID']);
    
    $arrayJson = [
        $cat::TABLE_NAME => $categories,
        $prodCat::TABLE_NAME => $prod_cat,
    ];

    echo(json_encode($arrayJson));