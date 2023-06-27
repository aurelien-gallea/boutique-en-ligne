<?php 

    session_start();

    spl_autoload_register(function($classes) {
        require_once('../' .$classes. '.php');
    });
    
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
