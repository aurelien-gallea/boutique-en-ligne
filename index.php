<?php
session_start();

$title = "Accueil";
    ob_start();
    ?>


<?php 
$content = ob_get_clean();
require_once("./Templates/base.php");
?>