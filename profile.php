<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:./signIn.php');
    exit();
}
$userId = $_SESSION['userId'];



$title = "Mes Infos";
$home = "./";
$admin = "./admin/";
$products = "./allproducts.php";
$cart = "./mycart.php";

require_once("./php/Components/head.php");
require_once("./php/Components/header.php");

?>
<section class="dark:bg-gray-600 min-h-screen ">

    <div class="container mx-auto p-8  flex flex-col items-center bg-color-5 dark:bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-t-md">
        <h1 class="dark:text-white text-3xl">Modifier Profil</h1>
        <div id="block1" class="">
            <hr>

            <form class="space-y-4 md:space-y-6" action="profile.php" method="post">
                <div class="mt-3">
                    <h2 class="dark:text-white text-xl">Changement Prénom / Nom</h2>
                </div>
                <div>
                    <div class="">
                        <label for="firstname" class="dark:text-white">Prénom</label>
                        <input id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="firstname" id="firstname" value="<?= $_SESSION["firstname"] ?>">
                    </div>
                </div>
                <div>

                    <div class="">
                        <label for="lastname" class="dark:text-white">Nom</label>
                        <input id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="lastname" id="lastname" value="<?= $_SESSION['lastname'] ?>">
                    </div>

                </div>
                <div>
                    <div class="">
                        <label for="password" class="dark:text-white">Mot De Passe</label>
                        <input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password" id="password" placeholder="Confirmer Mot De Passe">
                    </div>
                </div>
                <small class="text-red-500 ">Confirmer votre MDP pour modifier les informations</small>

                <div id="divBtn" class="p-2  w-full bg-color-3 dark:bg-color-4 text-center border rounded-md text-xl hover:bg-white hover:text-black">
                    <button id="btn" class="w-full" type="submit">Modifier mes informations</button>
                </div>
            </form>
            <button id="passWindow" class="my-5 text-white hover:text-orange-500">changer le mot de passe ?</button>
        </div>
        <div id="block2">
            <hr>
            <form action="profile.php" method="post" class="flex flex-col justify-center gap-5">



                <div class="mt-3">
                    <h2 class="text-white text-xl">Changement de mot de passe</h2>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="">
                        <label for="passChange1" class="dark:text-white">Confirmer votre mot de passe</label>
                        <input id="passChange1" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="passChange1" placeholder="Mot De Passe Actuel">
                    </div>
                    <div class="">
                        <label for="passChange2" class="dark:text-white">Nouveau mot de passe</label>
                        <input id="passChange2" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="passChange2" placeholder="Nouveau Mot De Passe">
                    </div>
                    <div>
                        <div class="">
                            <label for="passChange3" class="dark:text-white">Confirmation nouveau MDP</label>
                            <input id="passChange3" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="passChange3" placeholder="Confirmer nouveau MDP ">
                        </div>
                    </div>
                    <small id="notMatch" class="text-red-500">Les Mots de passes ne correspondent pas</small>
                    <div id="divBtn2">
                        <button id="btn2" class="p-2   w-full bg-color-3 dark:bg-color-4 text-center text-white border rounded-md text-xl hover:bg-white hover:text-black">Soumettre</button>
                    </div>
                </div>


            </form>
            <button id="userWindow" class="my-5 text-white hover:text-orange-500">changer l'identifiant / l'email ?</button>
        </div>


    </div>
</section>
<?php
require_once("./php/Components/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>
<script type="module" src="assets\js\products\profile.js"></script>
<?= !empty($script) ? $script : ''; ?>
</body>

</html>