<?php
session_start();

require('php/DB/DBManager.php');
require('php/DB/DBTables.php');

$title = "Accueil";
    ob_start();
    ?>


<?php 
$content = ob_get_clean();

ob_start(); ?>
<script type="module" src="./assets/js/products/productsCards.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>