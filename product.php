<?php
session_start();

$title = "Produit | M.A.H";
ob_start();
?>

<!-- styliser à partir d'ici -->
<div class="flex flex-grow items-center gap-3 my-6 justify-center">

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
            <div id="js-btnSubContainer">
                <!-- radios créés depuis le js : ref = btnColor -->
            </div>
        </div>
        <div id="js-addToCartContainer">
            <select id="js-select" class="mx-2">
                <!-- créés despuis le js -->
            </select>
            <input type="number" id="js-quantity" value="1" max="10">
            <button type="submit" id="js-addToCart" class="border rounded-full m-3 py-2 px-4">Ajouter au panier</button>
        </div>
    </div>
</div>
    <!-- fin -->
<?php 
$content = ob_get_clean();

ob_start(); ?>
<script type="module" src="./assets/js/products/product.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");
?>