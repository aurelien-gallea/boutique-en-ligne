<?php
    session_start();
    $_SESSION['productID'] = $_GET['id'];
    
    
    $title = $_GET['name'] . " | M.A.H";
    $home = "./";
    $admin = "./admin/";
    $products = "./allproducts.php";
    $cart = "./mycart.php";
    
    require_once("./php/Components/head.php");
    require_once("./php/Components/header.php");
?>

<div class="min-h-screen">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div id="main-container" class="min-h-screen shadow-md bg-gray-50 lg:min-w-[1024px] dark:bg-gray-700">
            <div id="grid_prod" class="flex gap-2 lg:max-w-screen-xl">

            </div>
        </div>
    </div>
</div>

<script type="module" src="./assets/js/products/product.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>

<?php
    require_once("./php/Components/footer.php");
?>