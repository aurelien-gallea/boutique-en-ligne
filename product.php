<?php
session_start();

$title = "Produit | M.A.H";
ob_start();
?>
    

<?php 
$content = ob_get_clean();

ob_start(); ?>
<script type="module" src="./assets/js/products/product.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");
?>