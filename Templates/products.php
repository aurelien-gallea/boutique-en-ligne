<?php
session_start();

$title = "Tous les produits | M.A.H";
$home = "../";
 
require_once("../php/Components/head.php");
require_once("../php/Components/header.php");
?>

<div class="min-h-screen">
    <div class="flex flex-col items-center min-h-screen w-full dark:bg-gray-800">
        <div class="flex lg:max-w-screen-xl h-full shadow-md bg-gray-50">
            <div id="grid_prod" class="grid grid-cols-2 md:grid-cols-3 gap-4 dark:bg-gray-700 p-8">
                
            </div>
        </div>
    </div>
</div>
        
<?php
    require_once("../php/Components/footer.php");
?>

<script type="module" src="../assets/js/products/allproducts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="../assets/js/modules/darkmode.js"></script>