<?php
session_start();

use Classes\Products;
use Classes\Images;
use Classes\Price;
use Classes\Color;
use Classes\Size;
use Classes\Stock;
use Classes\Prod_cat;

spl_autoload_register(function ($classes) {
    require_once('../' . $classes . '.php');
});

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];

$destination = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/" . $directory;

if (isset($_POST['valider'])) {
    if (empty($_POST['title'])) {
        echo "Le titre est manquant";
    } else if (empty($_POST['description'])) {
        echo "La description est manquante";
    } else if (empty($_FILES['images'])) {
        echo "le média est manquant";
    } else if (empty($_POST['price'])) {
        echo "Le prix du produit n'a pas été choisi.";
    } else if (empty($_POST['color'])) {
        echo "La couleur du produit n'a pas été choisi.";
    } else if (empty($_POST['size'])) {
        echo "La taille du produit n'a pas été choisi.";
    } else if (empty($_POST['quantity'])) {
        echo "La quantité du produit n'a pas été choisi.";
    } else if (empty($_POST['selectCategories'])) {
        echo "La catégorie du produit n'a pas été choisi.";
    } else {
        $prod = new Products();
        $newProductId = $prod->updateProduct($_POST['title'], $_POST['description'], $_SESSION['productID']);
    }

    if ($_SESSION['productID'] && $_FILES['images'] !== null) {
        $images = $_FILES['images'];

        $count = count($images['name']);

        for ($i = 0; $i < $count; $i++) {
            $image = $images['name'][$i];
            $fichiertmp = $images['tmp_name'][$i];

            $url = $_SERVER['SCRIPT_FILENAME'];
            $path = parse_url($url, PHP_URL_PATH);
            $directory = explode('/', $path)[3];

            $dest = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/Public/img/product/' . $image;

            if (move_uploaded_file($fichiertmp, $dest)) {
                $img = new Images();
                $newImg = $img->add($image, $_SESSION['productID']);
            };
        }
    }

    if ($_SESSION['productID'] && $_POST['price'] !== null) {
        $price = new Price();
        $price->updatePrice($_POST['price'], $_SESSION['productID']);
    }

    if ($_SESSION['productID'] && $_POST['color'] !== null && $_POST['size'] !== null && $_POST['quantity'] !== null) {
        $colors = $_POST['color'];
        $sizes = $_POST['size'];
        $quantities = $_POST['quantity'];

        $count = count($colors);

        for ($i = 0; $i < $count; $i++) {
            $color = $colors[$i];
            $size = $sizes[$i];
            $quantity = $quantities[$i];

            $colorInstance = new Color();
            $existingColor = $colorInstance->findByProductAndColor($_SESSION['productID'], $color);

            if ($existingColor) {
                $newColorId = $existingColor->getId();

                // Vérifier si la taille existe déjà pour cette couleur
                $sizeInstance = new Size();
                $existingSize = $sizeInstance->findByColorAndSize($newColorId, $size);

                if ($existingSize) {
                    // Si la quantité a été modifiée, ajouter la nouvelle quantité à la quantité existante
                    $stockInstance = new Stock();
                    $existingQuantity = $stockInstance->findBySize($existingSize->getId());

                    if ($existingQuantity) {
                        // $newQuantity = $existingQuantity->getQuantity() + $quantity;
                        $stockInstance->updateQuantity($existingQuantity->getId(), $quantity);
                    }
                } else {
                    // Vérifier si la taille existe déjà pour une autre couleur
                    $existingSize = $sizeInstance->findBySize($size);

                    if ($existingSize) {
                        // Associer la taille existante à cette couleur
                        $newSizeId = $existingSize->getId();
                    } else {
                        // Ajouter une nouvelle taille
                        $newSize = new Size();
                        $newSizeId = $newSize->add($size, $newColorId);
                    }

                    // Ajouter une nouvelle quantité
                    $newQuantity = new Stock();
                    $newQuantityId = $newQuantity->add($quantity, $newSizeId);
                }
            } else {
                $newColor = new Color();
                $newColorId = $newColor->add($color, $_SESSION['productID']);

                // Vérifier si la taille existe déjà pour une autre couleur
                $sizeInstance = new Size();
                $existingSize = $sizeInstance->findBySize($size);

                if ($existingSize) {
                    // Associer la taille existante à cette couleur
                    $newSizeId = $existingSize->getId();
                } else {
                    // Ajouter une nouvelle taille
                    $newSize = new Size();
                    $newSizeId = $newSize->add($size, $newColorId);
                }

                // Ajouter une nouvelle quantité
                $newQuantity = new Stock();
                $newQuantityId = $newQuantity->add($quantity, $newSizeId);
            }
        }
    }

    if ($_SESSION['productID'] && $_POST['selectCategories'] !== null) {
        $prod_cat = new Prod_cat();
        $prod_cat->updateCategory($_SESSION['productID'], $_POST['selectCategories']);
    }

    header('location: ' . $destination . '/admin/iframe/allProducts.php');
}
