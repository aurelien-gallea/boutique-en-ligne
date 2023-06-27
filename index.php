<?php
session_start();

require('php/DB/DBManager.php');
require('php/DB/DBTables.php');

$title = "Accueil";
$home = "./";
$admin = "./admin/";
$products = "./allproducts.php";
$cart = "./mycart.php";

require_once("./php/Components/head.php");
require_once("./php/Components/header.php");
?>

<div class="min-h-screen w-full">
    <div class="flex flex-col h-full w-full">
        <div class="w-full h-full overflow-hidden">
            <div class="max-[639px]:relative h-72 max-[425px]:w-[500px] max-[639px]:w-full sm:h-[300px] sm:w-full md:h-[400px] lg:h-[500px] xl:h-[600px]">
                <img class=" h-full sm:w-full sm:h-full sm:right-0 sm: max-[639px]:absolute max-[320px]:right-[180px] max-[375px]:right-[125px] max-[425px]:right-[75px] " src="./Public/img/banniere.png" alt="">
            </div>
        </div>
        <h2>Tous les produits</h2>
        <div id="lastProduct" class="flex overflow-x-auto overflow-y-hidden gap-6 w-full pt-4 scroll-smooth mb-2">

        </div>
        
    </div>

</div>




<?php
require_once("./php/Components/footer.php");

?>
<script type="module" src="./assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>

</html>