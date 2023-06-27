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
    <div id="prodContainer" class="flex flex-col p-4 justify-start items-end w-full overflow-x-auto">
      <a id="addProd" href="./addProduct.php" class=" text-center w-[180px] md:max-w-[250px] xl:max-w-[200px] text-[#AD785D] bg-white border border-[#AD785D] focus:outline-none hover:bg-[#AD785D] hover:text-white focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm  py-2.5 mr-2 mb-2 dark:bg-[#FFF9F5]/30 dark:text-[#AD785D] dark:hover:text-white dark:border-[#AD785D] dark:hover:bg-[#AD785D] dark:focus:ring-gray-700">
        <!-- <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
        </svg> -->
        Ajouter un produit
      </a>
    </div>

  </main>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <script type="module" src="../../assets/js/admin/allProducts.js"></script>
  <script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>