<?php
session_start();
    $title = "Connexion";
    ob_start();
?>

   
    <div class=""> 
           <!--  a voir si on garde -->
        <?php 
            if (isset($_GET["success"])){
            if ($_GET["success"] == 1) { ?>

                <p class=""><?=$_GET["message"] ?></p>  
            
        <?php }
        } 
        if (isset($_GET["error"])){
            if ($_GET["error"] == 1) { ?>

                <p class=""><?=$_GET["message"] ?></p>  

        <?php }
        }
        ?>
         <!-- fin du com précédent -->

            <div class=""> 
                <!-- En-tête de la carte -->
                <div class="">
                    <div class=""> Connection </div>
                </div>

                <!-- Corps -->
                <div class="">
                    <form  class="" method="post" action="">
                             
                        <p class="">
                            <!-- Mot de passe n'est affiché que sur les grands écrans -->
                            <label class="" for="password">Mot de passe :</label>
                            <input class="" type="password" name="password" id="password" placeholder="Entrer votre mot de passe" required>
                        </p>
                        <button class="" type="submit">Se connecter</button>  
                    </form>
                </div>
                <!-- Pied -->
                <div class="">            
                    <div class="">
                        <p class="">Pas encore membre ? <a href="signIn.php"><i>inscrivez-vous</i></a></p>
                    </div>                    
                </div>
            </div>
        
    </div>

   
<?php 
$content = ob_get_clean();
require_once("./Templates/base.php");

?>