<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header('location:./signIn.php');
        exit();
    }
    
    $userId = $_SESSION['userId'];
    
    $title = "Paiement";
    $home = "./";
    $admin = "./admin/";
    $products = "./allproducts.php";
    $cart = "./mycart.php";
    
    require_once("./php/Components/head.php");
    require_once("./php/Components/header.php");
?>
<div class="min-h-screen">
    <div class="flex flex-col lg:items-center min-h-screen w-full dark:bg-gray-800">
        <div class="min-h-screen shadow-md bg-gray-50 lg:min-w-[1024px] dark:bg-gray-700">
            <section id="" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
                <div class="flex flex-col items-center px-6 py-4 mx-auto ">
                    <h1 class="text-center dark:text-white text-2xl pb-6">Processus de paiement</h1>
                    <div class="dark:text-white w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <div id="messageInfo" class="flex justify-center gap-2 items-center"></div>
                        </div>
                    </div>

            </section>
        </div>
    </div>
</div>

<script type="module" src="./assets/js/products/gz.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
<?php
require_once("./php/Components/footer.php");
?>
