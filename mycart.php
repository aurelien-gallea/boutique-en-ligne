<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Cart;

$title = "Panier";
    ob_start();
    ?>
<h1 class="text-center">Mon Panier</h1>
<div class="text-center text-xl">Id utilisateur =  <?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : null ?></div>
<form id="confirmCart" action="" method="POST">

    
    <?php 
    
    $content = ob_get_clean();
    
    ob_start(); ?>
</form>
<script type="module" src="./assets/js/products/myCart.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>