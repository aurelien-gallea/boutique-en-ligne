<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}

$userId = $_SESSION['userId'];

spl_autoload_register(function ($classes) {
    require_once('./php/' . $classes . '.php');
});

$title = "Résumé de la commande";
ob_start();
?>
<section id="" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="flex flex-col items-center px-6 py-4 mx-auto ">
        <h1 class="text-center dark:text-white text-2xl pb-6">Récapitulatif de commande</h1>
        <div class="dark:text-white w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <table id="orderTable">
                    <tr>
                        <th class="pr-6 pl-2 border">nom</th>
                        <th class="pr-6 pl-2 border">qté</th>
                        <th class="pr-6 pl-2 border">prix</th>
                        <th class="pr-6 pl-2 border">prix total</th>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="pr-4 pl-2 border">montant total :</th>
                        <th id="totalAmount" class="pr-4 pl-2 border"></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center px-6 py-4 mx-auto ">
        <h2 class="text-center dark:text-white text-2xl pb-6">Livré à l'adresse suivante</h2>
        <div class="dark:text-white w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div id="fullAddress"></div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center px-6 py-4 mx-auto ">
        <h2 class="text-center dark:text-white text-2xl pb-6">Service de livraison choisi</h2>
        <div class="dark:text-white w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div id="carriersChoice"></div>
            </div>
        </div>
    </div>
    <div class="flex justify-center py-6 ">
        <button id="confirmOrder" type="button" class="border rounded-full px-3 py-2 md:px-4 md:py-3 leading-tight tracking-tight text-gray-900  dark:text-white">Payer la commande</button>
    </div>
</section>



<?php

$content = ob_get_clean();

ob_start(); ?>

<script type="module" src="./assets/js/products/myCurrentOrder.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>