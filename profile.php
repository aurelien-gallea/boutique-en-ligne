<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}
$userId = $_SESSION['userId'];

$title = "Résumé de la commande";
$home = "./";
$admin = "./admin/";
$products = "./allproducts.php";
$cart = "./mycart.php";

require_once("./php/Components/head.php");
require_once("./php/Components/header.php");

?>

<form action="profil.php" method="post" class="flex flex-col justify-center gap-5">



<div class="mt-3">
    <h2 class="text-white text-xl">Changement de mot de passe</h2>
</div>
<div class="flex flex-col gap-5">
    <div class="flex  justify-center">
        <label for="passChange1" class="bg-color-3 dark:bg-color-4 p-2 mt-3 rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
        <input id="passChange1" class="p-2 rounded-r-md mt-3 text-xl" type="password" name="passChange1" id="passChange1" placeholder="Mot De Passe Actuel">
    </div>
    <div class="flex  justify-center">
        <label for="passChange2" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
        <input id="passChange2" class="p-2 rounded-r-md text-xl" type="password" name="passChange2" id="passChange2" placeholder="Nouveau Mot De Passe">
    </div>
    <div>
        <div class="flex  justify-center ">
            <label for="passChange3" class="bg-color-3 dark:bg-color-4 p-2   rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone mot de passe"></label>
            <input id="passChange3" class="p-2 rounded-r-md text-xl" type="password" name="passChange3" id="passChange3" placeholder="Confirmer nouveau MDP ">
        </div>
    </div>
    <small id="notMatch" class="text-red-500">Les Mots de passes ne correspondent pas</small>
    <div id="divBtn2">
        <button id="btn2" class="p-2   w-full bg-color-3 dark:bg-color-4 text-center text-white border rounded-md text-xl hover:bg-white hover:text-black">Soumettre</button>
    </div>
</div>


</form>
<?php
require_once("./php/Components/footer.php");
?>
<script type="module" src="./assets/js/products/myCurrentOrder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>
</html>
