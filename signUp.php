<?php
session_start();
$title = "Inscription";

spl_autoload_register(function ($classes) {
    require_once('./php/' . $classes . '.php');
});

use Classes\User;
use Classes\Verify;

if (isset($_POST['signUp'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
        if ($_POST['password'] === $_POST['confirm-password']) {

            $email = htmlspecialchars($_POST['email']);
            $pass1 = htmlspecialchars($_POST['password']);
            $pass2 = htmlspecialchars($_POST['confirm-password']);

            // a finir ne pas oublier de rajouter les conditions au dessus !
            $firstname = "pipo";
            $lastname = "molo";
            // fin

            // verifications du mail (au cas où l'utilisateur change le type de l'input)
            if (!Verify::verifySyntax($email)) {
                header('location:signUp.php?error=1&message=merci de rentrer un email valide !');
                exit();
            }
            $user = new User();

            // doublon mail
            if ($user->avalaibleEmail($email) !== 0) {
                header('location:signUp.php?error=1&message=adresse email déjà utilisée !');
                exit();
            }

            $password = password_hash($pass1, PASSWORD_BCRYPT);
            $user->addNew($email, $password, $firstname, $lastname);
            header('location:./signIn.php');
            exit();
        } else {
            header('location:signUp.php?error=1&message=Les mots de passes ne correspondent pas !');
            exit();
        }
    }
}
ob_start();
?>

<!-- fin du com précédent -->

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">

        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Créer un compte
                </h1>
                <form class="space-y-4 md:space-y-6" method="post" action="">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre adresse e-mail</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                        <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
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
                    <button type="submit" name="signUp" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer un compte</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Vous avez déjà un compte ? <a href="./signIn.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500" style="color: #AD785D">Connectez-vous ici</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</section>


</div>

</div>

</div>
<?php
$content = ob_get_clean();
require_once("./Templates/base.php");
?>