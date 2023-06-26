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

    <main class="sm:pl-64 pt-[64px] min-h-screen bg-gray-100 dark:bg-gray-700">
        <div class="flex pt-4 justify-center w-full pb-5">
            <form class="flex flex-col w-11/12 md:w-5/12 h-full space-y-5" action="../../php/Controller/verifNewCarrier.php" method="POST">
                <div class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800 dark:border">
                    <h2 class="text-md font-medium dark:text-white">Transporteur</h2>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Nom</label>
                        <input type="text" id="name" name="name" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-white dark:focus:border-white">
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">description</label>
                        <textarea type="text" id="description" name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">prix</label>
                        <input type="number" step=0.01 id="price" name="price" class="block w-1/3 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <button name="valider" type="submit" class="text-white bg-blue-700 mt-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enregistrer</button>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>