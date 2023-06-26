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

<main class="w-full sm:pl-64 pt-[64px] min-h-screen bg-gray-100 dark:bg-gray-700" id="main">
    
</main>

  <!-- <script type="module" src="../../assets/js/admin/allProducts.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>