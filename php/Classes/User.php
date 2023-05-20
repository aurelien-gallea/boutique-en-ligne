<?php

namespace Classes; 

class User {

    const TABLE_NAME = "user";
    // methodes
    public function avalaibleEmail($email){
        require_once('php/DB/DBManager.php');
        $requete = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE email = ? ");
        $requete->execute([$email]);
        return $requete->rowCount();
    }
    
    //  incrire un utilisateur
    // role en dernier car optionnel

    // public function addUser ()
    // {
    //    $bdd = $this->connection();
    //    $requete = $bdd->prepare("INSERT INTO " .$this::TABLE_NAME. " email = " .$email. " AND" )
    // }


}
?>
