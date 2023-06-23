<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header('location:./signIn.php');
        exit();
    }

    $title = "Panier";
    $home = "./";
    $admin = "./admin/";
    $products = "./allproducts.php";
    $cart = "./mycart.php";

    require_once("./php/Components/head.php");
    require_once("./php/Components/header.php");
?>

<div class="min-h-screen">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div class="min-h-screen shadow-md bg-gray-50 lg:min-w-[1024px] dark:bg-gray-700">
            <h1 class="text-center">Mon Panier</h1>
            <div class="text-center text-xl">Id utilisateur = <?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : null ?></div>
            <form id="confirmCart" action="" method="POST">

            </form>
        </div>
    </div>
</div>

<script type="module" src="./assets/js/products/myCart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>

<?php
require_once("./php/Components/footer.php");
?>