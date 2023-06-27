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

<div class="min-h-screen dark:text-white bg-[#AD785D]/30">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800 ">
        <div class="min-h-screen shadow-md bg-[#AD785D]/30 lg:min-w-[1024px] dark:bg-gray-700">
            <h1 class="text-center text-3xl my-5">Mon Panier</h1>
            
            <form id="confirmCart" class="bg-[#FFF9F5] dark:bg-gray-800" action="" method="POST">

            </form>
        </div>
    </div>
</div>
<?php
require_once("./php/Components/footer.php");
?>
<script type="module" src="./assets/js/products/myCart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>
</html>