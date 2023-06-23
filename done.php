<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}

$userId = $_SESSION['userId'];

$title = "Paiement";
ob_start();
?>
<section id="" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="flex flex-col items-center px-6 py-4 mx-auto ">
        <h1 class="text-center dark:text-white text-2xl pb-6">Processus de paiement</h1>
        <div class="dark:text-white w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <p id = "messageInfo" class="text-center"></p>
            </div>
        </div>
    
</section>



<?php

$content = ob_get_clean();

ob_start(); ?>

<script type="module" src="./assets/js/products/gz.js"></script>
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>