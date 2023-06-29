<?php 

    session_start();

    require_once('../Classes/Images.php');
    require_once('../Classes/Prod_cat.php');
    require_once('../Classes/Price.php');
    
    use Classes\Images;
    use Classes\Prod_cat;
    use Classes\Price;

    $img = new Images();
    $prod_cat = new Prod_cat();
    $price = new Price();
   
    $ProdCat = $prod_cat->getAllProductsByCategory_id($_SESSION['catID']);
    $images = $img->getAll();
    $prices = $price->getAll();

    $arrayJson = [
        $img::TABLE_NAME => $images,
        $prod_cat::TABLE_NAME => $ProdCat,
        $price::TABLE_NAME => $prices,
    ];

    echo(json_encode($arrayJson));
