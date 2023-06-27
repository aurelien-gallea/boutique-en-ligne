<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}

$userId = $_SESSION['userId'];



$title = "Mes Commandes";
$home = "./";
$admin = "./admin/";
$products = "./allproducts.php";
$cart = "./mycart.php";

require_once("./php/Components/head.php");
require_once("./php/Components/header.php");
?>

<section class="dark:bg-gray-600 min-h-screen ">
<div class="container dark:text-white mx-auto p-8 ">
        <h1 class=" text-3xl text-center">Mes Commandes</h1>
        <div class="mt-5 text-left">

            <h2 class="text-2xl my-5">Dernière commande</h2>
            <div id="lastOrder" class="flex flex-col gap-3"></div>
        </div>
        <hr>
        <div class="mt-5 text-left ">

            <h2 class="text-2xl my-5">Commandes passées</h2>
            <div id="orders" class="flex flex-col gap-3"></div>
        </div>
</section>
<?php
require_once("./php/Components/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<script type="module" src="assets\js\products\myorders.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>

</html>