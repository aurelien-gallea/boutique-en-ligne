<?php
session_start();
$_SESSION['productID'] = $_GET['id'];


$title = $_GET['name'] . " | M.A.H";
$home = "../";
$admin = "../admin/accueiladmin.php";
$products = "./products.php";
$cart = "../mycart.php";
// ob_start();

require_once("../php/Components/head.php");
require_once("../php/Components/header.php");
?>

<div class="min-h-screen">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div class="min-h-screen shadow-md bg-gray-50 lg:min-w-[1024px] dark:bg-gray-700">
            <div id="grid_prod" class="flex gap-2 lg:max-w-screen-xl">

            </div>
        </div>
    </div>
</div>
<!-- styliser à partir d'ici -->
<!-- <div class="flex flex-grow items-center gap-3 my-6 justify-center">

    <div id="js-card" class="flex flex-col border rounded p-2 w-80 gap-3">
        <div>
            <span id="js-productName"></span>
            <img id="js-cardImg" src="" alt="">
        </div>
        <div>
            <p id="js-cardDesc"></p>
        </div>
    </div>
    <div>
        <div id="js-btnContainer">
            <div><span id="js-price" class="text-2xl"></span></div>
            <div id="js-btnSubContainer"> -->
<!-- radios créés depuis le js : ref = btnColor -->
<!-- </div>
        </div>
        <div id="js-addToCartContainer">
            <select id="js-select" class="mx-2"> -->
<!-- créés despuis le js -->
<!-- </select>
            <input type="number" id="js-quantity" value="1" max="10">
            <button type="submit" id="js-addToCart" class="border rounded-full m-3 py-2 px-4">Ajouter au panier</button>
        </div>
    </div>
</div> -->
<!-- fin -->
<?php
// $content = ob_get_clean();

// ob_start(); 
?>
<script type="module" src="../assets/js/products/test.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="../assets/js/modules/darkmode.js"></script>
<?php
require_once("../php/Components/footer.php");
// $script = ob_get_clean();
// require_once("./Templates/base.php");
?>