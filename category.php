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
<div class="min-h-screen dark:text-white bg-[#AD785D]/30">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div class="min-h-screen shadow-md bg-gray-50 lg:min-w-[1024px] dark:bg-gray-700">

        </div>
    </div>
</div>

<?php
require_once("./php/Components/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>

</html>