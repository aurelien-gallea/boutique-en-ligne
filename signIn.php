<?php
session_start();
$title = "Connexion";
spl_autoload_register(function ($classes) {
    require_once('./php/' . $classes . '.php');
});

use Classes\User;

if (isset($_POST['signIn'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);

        $user = new User();

        $hachedPassword = $user->passVerify($email, $pass);

        if ($hachedPassword !== false) {
            $response = $user->connection($email, $hachedPassword);
            $_SESSION["userId"] = $response["id"];
            $_SESSION["email"] = $response["email"];
            $_SESSION["role"] = $response["role"];

            header("location:./");
            exit();
        } else {
            header('location:./signIn.php?error=1&message=Nom d\'utilisateur ou mot de passe incorrect. Veuillez réessayer.');
            exit();
        }
    }
}


ob_start();
?>


    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">

            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Connectez-vous à votre compte
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
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">

                                </div>
                                <div class="ml-3 text-sm">

                                </div>
                            </div>

                        </div>
                        <?php
                        if (isset($_GET['error']) && !empty($_GET['message'])) {
                            echo '<span class="">' . htmlspecialchars($_GET['message']) . '</span>';
                        }
                        ?>
                        <button type="submit" name="signIn" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Connexion</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Vous n’avez pas encore de compte ? <a href="./signUp.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500" style="color: #AD785D">S’enregistrer</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <?php
    $content = ob_get_clean();
    require_once("./Templates/base.php");

    ?>