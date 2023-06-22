<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}

$userId = $_SESSION['userId'];

spl_autoload_register(function ($classes) {
    require_once('./php/' . $classes . '.php');
});

$title = "Résumé de la commande";
ob_start();
?>
<h1 class="text-center">Récapitulatif de commande</h1>
<div class="text-center text-xl">Id utilisateur = <?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : null ?></div>



    <?php

    $content = ob_get_clean();

    ob_start(); ?>

<!-- <script type="module" src="./assets/js/products/myCart.js"></script> -->
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>