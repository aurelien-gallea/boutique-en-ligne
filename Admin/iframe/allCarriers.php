<?php

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
    <div id="carrierContainer" class="flex flex-col p-4 justify-start items-end w-full overflow-x-auto">
      <a id="addCarrier" href="./addCarrier.php" class="text-white w-auto mb-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
        </svg>
        Ajouter un Transporteur
      </a>
    </div>
  </main>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <script type="module" src="../../assets/js/admin/allCarriers.js"></script>
  <script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>