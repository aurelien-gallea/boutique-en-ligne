<?php
session_start();
    $title = "Inscription";
    ob_start();
?>
<div class=""> 
     <!--a voir si on garde  -->
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
                <div class=""> Inscription </div>
            </div>
            <!-- Corps -->
            <div class="">
                <form  class="" method="post" action="">
                    <p class="">
                        <label class="" for="email">Email :</label>
                        <input class="" type="email" name="email" id="email" placeholder="Entrer un email valide" required>
                    </p>

                    <p class="">
                        <label class="" for="password">Mot de passe :</label>
                        <input class="" type="password" name="password" id="password" placeholder="Entrer un mot de passe" required>                    
                    </p>
                    <p class="">
                        <label class="" for="password">Verifier mot de passe :</label>
                        <input class="" type="password" name="password_two" id="password_two" placeholder="Répéter votre mot de passe" required>
                    </p>
                    <button class="" type="submit">S'inscrire</button>  
                </form>
            </div>
            <div class="">            
                    <div class="">                        
                        <p>Déja membre ? <a href="signUp.php"><i>connectez-vous</i></a></p>
                    </div>                    
                </div>

                
            
        </div>

    </div>
 
</div> 
<?php 
$content = ob_get_clean();
require_once("./Templates/base.php");
?>