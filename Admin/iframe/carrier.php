<?php
session_start();

$_SESSION['carrierID'] = $_GET['id'];

$title = "Transporteur | Admin";
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

<main class="sm:pl-64 pt-[64px] min-h-screen bg-[#FFF9F5] dark:bg-gray-700">
    <div class="flex pt-4 justify-center w-full pb-5">
        <form class="flex flex-col w-11/12 md:w-5/12 h-full space-y-5" action="../../php/Controller/updateCarrier.php" method="POST">
            <div class="flex flex-col shadow-md bg-white rounded-lg px-8 py-4 space-y-3 dark:bg-gray-800 dark:border">
                <h2 class="text-md font-medium dark:text-white">Transporteur</h2>
                
            </div>
            <button name="valider" type="submit" class="text-white bg-blue-700 mt-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enregistrer</button>
        </form>
    </div>
</main>
<script type="module" src="../../assets/js/admin/carrier.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="../../assets/js/modules/darkmode.js"></script>
</body>

</html>