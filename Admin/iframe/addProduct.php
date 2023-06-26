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
            <form class="flex flex-col w-11/12 md:w-5/12 h-full space-y-5" action="../../php/Controller/verifAddProduct.php" method="POST" enctype="multipart/form-data">

                <div class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800 dark:border">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Nom</label>
                        <input type="text" id="title" name="title" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-white dark:focus:border-white">

                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">description</label>
                        <textarea type="text" id="description" name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                </div>

                <div class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800">
                    <h2 class="text-md font-medium dark:text-white">Images</h2>
                    <div>
                        <label for="image" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Images</label>
                        <input type="file" id="image" name="images[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" multiple>
                    </div>
                </div>

                <div class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800">
                    <h2 class="text-md font-medium dark:text-white">Prix</h2>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">prix</label>
                        <input type="number" step=0.01 id="price" name="price" class="block w-1/3 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>

                <div id="Options" class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800">
                    <div class="space-y-3">
                        <h2 class="text-md font-medium dark:text-white">Options</h2>
                        <div class="flex gap-2 w-full">
                            <div class="w-full">
                                <label for="color" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Couleur</label>
                                <input type="text" id="color" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-full">
                                <label for="size" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Taille</label>
                                <input type="text" id="size" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-full">
                                <label for="quantity" class="block mb-2 text-sm font-normal text-gray-900 dark:text-white">Quantité</label>
                                <input type="number" id="quantity" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div id="addOptions" class="flex items-end pb-0.5 cursor-pointer">
                                <!-- <svg class="w-8 h-8 text-gray-600 shadow-lg rounded bg-gray-50 dark:text-white dark:bg-gray-700 dark:border-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"></path>
                                </svg> -->
                                <i class="fa-solid fa-arrow-turn-down fa-lg w-8 text-gray-600 shadow-lg rounded bg-gray-50 dark:text-white dark:bg-gray-700 dark:border-gray-600"></i>
                            </div>
                        </div>
                    </div>
                    <div id="containerTable" class="hidden flex-col w-full shadow-md bg-white rounded-lg p-4 space-y-3 dark:bg-gray-800 dark:border">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Couleur</th>
                                    <th scope="col" class="px-6 py-3">Taille</th>
                                    <th scope="col" class="px-6 py-3">Quantité</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>

                <button id="button" name="valider" type="submit" class="text-white bg-blue-700 mt-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enregistrer</button>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script type="module" src="../../assets/js/admin/addProduct.js"></script>
    <script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>