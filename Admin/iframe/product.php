<?php
session_start();

if (!isset($_SESSION["role"])) {
  header("location: ../");
  exit();
}
if (isset($_SESSION['role'])) {
  if ($_SESSION["role"] !== "admin") {
    header("location: ../");
    exit();
  }
}
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

<main class="w-full sm:pl-64 pt-[64px] min-h-screen bg-[#FFF9F5] dark:bg-gray-700" id="main">
  <div class="flex flex-col items-center p-4 w-full overflow-x-auto">
    <form id="prodContainer" class="flex flex-col w-11/12 md:w-10/12 lg:w-10/12 xl:w-8/12 h-full space-y-5" method="POST" action="../../php/Controller/updateProduct.php" enctype="multipart/form-data">

      <button id="button" name="valider" type="submit" class="w-full text-white bg-blue-700 mt-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mettre à jour</button>
    </form>
  </div>
</main>

<script type="module" src="../../assets/js/admin/product.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>