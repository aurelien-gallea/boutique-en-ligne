<?php
session_start();

$_SESSION['productID'] = $_GET['id'];
// spl_autoload_register(function($classes) {
//     require_once('./php/' .$classes. '.php');
// });

// use Classes\Products;
// use Classes\Images;
// use Classes\Stock;

// $prod = new Products();
// $image = new Images();
// $stock = new Stock();

$title = "Produit | M.A.H";
ob_start();

// $resp = $prod->getAllById($idProduct);
// $img = $image->getAllByProductId($idProduct);
// $stk= $stock->getAllInfosByProductId($idProduct);
// var_dump($resp, "<br>",  $img, "<br>", $stk);
?>
    

<?php 
$content = ob_get_clean();

ob_start(); ?>
<script type="module" src="./assets/js/products/product.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");
?>