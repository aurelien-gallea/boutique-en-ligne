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

    // si l'utilisateur a un panier vide il est redirigé vers son panier
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

    $myCarriers = new Carriers();
    $carriers = $myCarriers->getAll();

    if (isset($_POST['confirmAddress'])) {

        if (
            !empty($_POST['nameAddress']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])
            && !empty($_POST['address']) && !empty($_POST['postalCode']) && !empty($_POST['city'])
            && !empty($_POST['country']) && !empty($_POST['phone'])
        ) {

            $nameAddress = htmlspecialchars($_POST['nameAddress']);
            $firstname  = htmlspecialchars($_POST['firstname']);
            $lastname   = htmlspecialchars($_POST['lastname']);
            $address     = htmlspecialchars($_POST['address']);
            $postalCode = htmlspecialchars($_POST['postalCode']);
            $city       = htmlspecialchars($_POST['city']);
            $country    = htmlspecialchars($_POST['country']);
            $phone      = htmlspecialchars($_POST['phone']);

            if ($myDelivery->avalaibleName($nameAddress) === 0) {
                $myDelivery->addNew($nameAddress, $firstname, $lastname, $address, $postalCode, $city, $country, $phone, $userId);
            }
        }
    }

    $title = "Livraison";
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
            <h1 class="text-center">Mon adresse de livraison</h1>
            <section id="myChoice" class="bg-gray-50 dark:bg-gray-900">
                <div class="flex flex-col items-center px-6 py-8 mx-auto ">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h2 class="text-2xl text-center font-bold leading-tight tracking-tight text-gray-900  dark:text-white">
                                Où doit-on vous livrer ?
                            </h2>
                        </div>
                        <div class="flex justify-around pb-6">
                           
                                <button id="btnMyAddress" type="button" class="border rounded-full px-3 py-2 md:px-4 md:py-3 leading-tight tracking-tight text-gray-900  dark:text-white">adresse existante</button>
                            
                            <button id="btnNewAddress" type="button" class="border rounded-full px-3 py-2 md:px-4 md:py-3 leading-tight tracking-tight text-gray-900  dark:text-white">nouvelle adresse</button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- bloc adresses existantes -->
            <section id="myAddress" class="bg-gray-50 dark:bg-gray-900 hidden">
                <div class="flex flex-col items-center px-6 py-8 mx-auto  ">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900  dark:text-white">
                                Sélectionnez votre adresse de livraison
                            </h3>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-center gap-4 items-center pb-6 ">
                            <div class="pb-6 ">


                                <?php foreach ($delivery as $key => $value) { ?>
                                    <div class="flex items-center gap-2 p-2 text-gray-900 dark:text-white">
                                        <input class="js-delivery" type="radio" name="delivery" value="<?= $value['name'] ?>" />
                                        <label for="<?= $value['name'] ?>"><?= $value['name'] . " (" . $value['postalCode'] . ") " . $value['city']  ?></label>
                                        <input type="hidden" class="jsFirstname" value="<?= $value['firstname'] ?>">
                                        <input type="hidden" class="jsLastname" value="<?= $value['lastname'] ?>">
                                        <input type="hidden" class="jsAddress" value="<?= $value['adress'] ?>">
                                        <input type="hidden" class="jsPostalCode" value="<?= $value['postalCode'] ?>">
                                        <input type="hidden" class="jsCity" value="<?= $value['city'] ?>">
                                        <input type="hidden" class="jsCountry" value="<?= $value['country'] ?>">
                                        <input type="hidden" class="jsPhone" value="<?= $value['phone'] ?>">
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- bloc nouvelle adresse -->
            <section id="newAddress" class="bg-gray-50 dark:bg-gray-900 hidden">
                <div class="flex flex-col items-center px-6 py-8 mx-auto ">

                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                                Ajouter une adresse de livraison
                            </h3>
                            <form id="addNewAddress" class="space-y-4 md:space-y-4" method="post" action="">
                                <div>
                                    <label for="nameAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du lieu de livraison</label>
                                    <input type="text" name="nameAddress" id="nameAddress" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                                    <p id="errorMsg" class="text-rose-600 pt-2 mb-0"> </p>
                                </div>
                                <div class="flex gap-3">

                                    <div>
                                        <label for="firstname" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre prénom</label>
                                        <input type="text" name="firstname" id="firstname" value=<?= !empty($user['firstname']) ? $user['firstname'] : ""; ?> class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    </div>
                                    <div>
                                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre nom</label>
                                        <input type="text" name="lastname" id="lastname" value=<?= !empty($user['lastname']) ? $user['lastname'] : ""; ?> class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    </div>
                                </div>

                                <div>
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                    <textarea name="address" id="address" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""></textarea>
                                </div>
                                <div>
                                    <label for="postalCode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Postal</label>
                                    <input type="tel" pattern="[0-9]{5}" name="postalCode" id="postalCode" placeholder="expl: 13001" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                                    <input type="text" name="city" id="city" placeholder="Votre ville" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pays</label>
                                    <input type="text" name="country" id="country" value="France" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                    <input type="tel" pattern="[0-9]{10}" name="phone" id="phone" <?= !empty($delivery) ? "value=" . $delivery[0]['phone']  : 'placeholder="Votre numéro ..."'; ?> class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">

                                    </div>
                                    <div class="ml-3 text-sm">

                                    </div>
                                </div>

                                <button id="confirmAddress" type="submit" name="confirmAddress" class="disabled:opacity-50 w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ajouter mon adresse de livraison</button>

                            </form>

                        </div>
                    </div>
                </div>

            </section>

            <!-- bloc adresse selectionné -->
            <section id="nextAddress" class="bg-gray-50 dark:bg-gray-900 hidden">
                <div class="flex flex-col items-center px-6 py-8 mx-auto ">

                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h3 id="titleNextAddress" class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">Votre lieu de livraison selectionné</h3>
                        </div>
                        <div id="contentNextAddress" class="text-gray-900 dark:text-white mx-6 py-4">
                            <h4 id="adName" class="pb-2"></h4>
                            <p id="person"></p>
                            <p id="adDelivery"></p>
                            <p id="adPcAndCity"></p>
                            <p id="adCountry" class="pb-2"></p>
                            <p id="adPhone"></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- bloc livreurs -->
            <section id="carriers" class="bg-gray-50 dark:bg-gray-900 hidden">
                <div class="flex flex-col items-center px-6 py-8 mx-auto ">

                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                                Choisissez votre livreur
                            </h3>
                        </div>
                        <div class="pb-6 ">


                            <?php foreach ($carriers as $key => $value) { ?>
                                <div class="flex items-center gap-2 p-2 text-gray-900 dark:text-white">
                                    <input class="js-carriers" type="radio" name="carriers" id="<?= $value['name'] ?>" value="<?= $value['name'] ?>" />
                                    <label for="<?= $value['name'] ?>"><?= $value['name'] . " (" . $value['description'] . ") " . $value['price'] . " €" ?></label>
                                    <input type="hidden" class="jsCarName" value="<?= $value['name'] ?>">
                                    <input type="hidden" class="jsCarDesc" value="<?= $value['description'] ?>">
                                    <input type="hidden" class="jsCarPrice" value="<?= $value['price'] ?>">
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-3 bg-gray-50 dark:bg-gray-900">
                    <button type="button" id="goBack" class="hidden border rounded-full px-3 py-2 md:px-4 md:py-3 leading-tight tracking-tight text-gray-900  dark:text-white">Retour au panier</button>
                    <button type="button" id="confirmAll" class="hidden border rounded-full px-3 py-2 md:px-4 md:py-3 leading-tight tracking-tight text-gray-900  dark:text-white">Étape suivante</button>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="module" src="./assets/js/products/myDelivery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="module" src="./assets/js/modules/darkmode.js"></script>

<?php
require_once("./php/Components/footer.php");
?>