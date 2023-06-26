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

  $title = "Accueil | Admin";
  $home = "./";
  $order = "#";
  $products = "./iframe/allProducts.php";
  $categories = "./iframe/allCategories.php";
  $users = "./iframe/allUsers.php";
  $carriers = "./iframe/allCarriers.php";
  $siteWeb = "../";

  require_once("../php/Components/head.php");
  require_once("../php/Components/headerAdmin.php");

?>

  <main class="sm:pl-64 pt-[64px] min-h-screen bg-gray-100 dark:bg-gray-700">
    
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <script src="../assets/js/modules/darkmode.js"></script>
</body>

</html>