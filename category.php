<?php
session_start();
$_SESSION['catID'] = $_GET['id'];
$_SESSION['name'] = $_GET['name'];

$title = "Tous les ".$_SESSION['name']."s  | M.A.H.";
$home = "./";
$admin = "./admin/";
$products = "./allproducts.php";
$cart = "./mycart.php";

require_once("./php/Components/head.php");
require_once("./php/Components/header.php");
?>
<div class="min-h-screen bg-[#AD785D]/30">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div class="min-h-screen shadow-md bg-[#AD785D]/30  lg:min-w-[1024px] dark:bg-gray-700">
            <div class="flex justify-center lg:max-w-screen-xl">
                <div id="grid_prod" class="grid grid-cols-2 lg:grid-cols-3 gap-4 dark:bg-gray-700 p-8">

                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("./php/Components/footer.php");
?>
<script type="module" src="./assets/js/products/productsbycategories.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>

</html>