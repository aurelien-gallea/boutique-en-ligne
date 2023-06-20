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

use Classes\Cart;
$myCart = new Cart();
$cart = $myCart->getAllByUserId($userId);

// si l'utilsateur a un panier vide il est redirigé vers son panier
if (empty($cart)) {
    header('location:./mycart.php');
    exit();
}


use Classes\User;
use Classes\Delivery;
use Classes\Carriers;

$myUser = new User();
$user = $myUser->getById($userId);

$myDelivery = new Delivery();
$delivery = $myDelivery->getAllByUserId($userId);
var_dump($delivery[0]['phone']);

if (isset($_POST['confirmAdress'])) {

    if (!empty($_POST['nameAdress']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) 
    && !empty($_POST['adress']) && !empty($_POST['postalCode']) && !empty($_POST['city'])
    && !empty($_POST['country']) && !empty($_POST['phone'])) {
        
        $nameAdress = htmlspecialchars($_POST['nameAdress']);
        $firstname  = htmlspecialchars($_POST['firstname']);
        $lastname   = htmlspecialchars($_POST['lastname']);
        $adress     = htmlspecialchars($_POST['adress']);
        $postalCode = htmlspecialchars($_POST['postalCode']);
        $city       = htmlspecialchars($_POST['city']);
        $country    = htmlspecialchars($_POST['country']);
        $phone      = htmlspecialchars($_POST['phone']);

        $myDelivery->addNew($nameAdress, $firstname, $lastname, $adress, $postalCode, $city, $country, $phone, $userId);
    }
}
// la vue -----------------------------------------------------------
$title = "Livraison";
ob_start();
?>
<h1 class="text-center">Mon adresse de livraison</h1>
<div class="text-center text-xl">Id utilisateur = <?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : null ?></div>

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">

        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Ajouter une adresse de livraison
                </h1>
                <form class="space-y-4 md:space-y-6" method="post" action="">
                    <div>
                        <label for="nameAdress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du lieu de livraison</label>
                        <input type="text" name="nameAdress" id="nameAdress" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                    </div>
                    <div class="flex gap-3">

                        <div>
                            <label for="firstname" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre prénom</label>
                            <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" value=<?= !empty($user['firstname']) ? $user['firstname'] : "" ?>>
                        </div>
                        <div>
                            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre nom</label>
                            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" value=<?= !empty($user['lastname']) ? $user['lastname'] : "" ?>>
                        </div>
                    </div>

                    <div>
                        <label for="adress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                        <textarea name="adress" id="adress" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""></textarea>
                    </div>
                    <div>
                        <label for="postalCode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Postal</label>
                        <input type="tel" pattern="[0-9]{5}" name="postalCode" id="postalCode" placeholder="expl: 13001" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                        <input type="text"  name="city" id="city" placeholder="Votre ville" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pays</label>
                        <input type="text" name="country" id="country" value="France" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                        <input type="tel" pattern="[0-9]{10}" name="phone" id="phone" <?= !empty($delivery) ? "value=".$delivery[0]['phone']  : 'placeholder="Votre numéro ..."' ?> class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">

                        </div>
                        <div class="ml-3 text-sm">

                        </div>
                    </div>
                    <?php
                    if (isset($_GET['error']) && !empty($_GET['message'])) {
                        echo '<span class="">' . htmlspecialchars($_GET['message']) . '</span>';
                    }
                    ?>
                    <button type="submit" name="confirmAdress" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ajouter mon adresse de livraison</button>
                    
                </form>
            </div>
        </div>
    </div>

</section>

<?php

$content = ob_get_clean();

ob_start(); ?>

<!-- <script type="module" src="./assets/js/products/myCart.js"></script> -->
<?php
$script = ob_get_clean();
require_once("./Templates/base.php");

?>