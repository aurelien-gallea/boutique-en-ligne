<?php
session_start();
$_SESSION['productID'] = $_GET['id'];

$title = "Transporeurs | Admin";
$home = "../";
$order = "#";
$products = "./allProducts.php";
$categories = "./allCategories.php";
$users = "./allUsers.php";
$carriers = "./allCarriers.php";
$siteWeb = "../../";

require_once("../../php/Components/head.php");
require_once("../../php/Components/headerAdmin.php");
?>

<main class="w-full sm:pl-64 pt-[64px] min-h-screen bg-gray-100 dark:bg-gray-700" id="main">
  <div class="flex flex-col items-center p-4 w-full overflow-x-auto">
    <div id="prodContainer" class="flex flex-col w-11/12 md:w-10/12 lg:w-10/12 xl:w-8/12 h-full space-y-5">

    </div>
  </div>
</main>

<script type="module" src="../../assets/js/admin/product.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>