<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"

class User { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $id;
    public $email;
    public $password;
    public $firstname; 
    public $lastname; 
    // private $role;
    // private $date_creation;
    
    const TABLE_NAME = "user"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->email;
        $this->password;
        $this->firstname;
        $this->lastname;
        // $this->role;
        // $this->date_creation;
    }

    // Getter et Setter de l'attribut $id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter et Setter de l'attribut $email
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter et Setter de l'attribut $password
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter et Setter de l'attribut $firstname
    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    // Getter et Setter de l'attribut $lastname
    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    // Getter et Setter de l'attribut $role
    // public function getRole() {
    //     return $this->role;
    // }

    // public function setRole($role) {
    //     $this->role = $role;
    // }

    // // Getter et Setter de l'attribut $date_creation
    // public function getDateCreation() {
    //     return $this->date_creation;
    // }

    // public function setDateCreation($date_creation) {
    //     $this->date_creation = $date_creation;
    // }

    
    





    


    // Méthodes

    /**
     * Vérifie si l'email est disponible dans la table user
     * @param string $email L'email à vérifier
     * @return int Le nombre de lignes correspondant à l'email dans la table user
     */
    public function AvalaibleEmail($email){
        require('./php/DB/DBManager.php');
        
        $requete = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE email = ? "); // Préparation d'une requête SQL pour sélectionner toutes les colonnes de la table user où l'email correspond au paramètre fourni
        $requete->execute([$email]); // Exécution de la requête préparée en remplaçant le paramètre "?" par la valeur de $email
        return $requete->rowCount(); // Retourne le nombre de lignes affectées par la requête, indiquant ainsi le nombre de résultats correspondant à l'email
    }


    public function CreateUser($email, $password, $firstname, $lastname) {
        require('./php/DB/DBManager.php');
        $requete = $bdd->prepare("INSERT INTO " . $this::TABLE_NAME . " (email, password, firstname, lastname) VALUES (?, ?, ?, ?)");
        $response = $requete->execute([$email, $password, $firstname, $lastname]);
        return $response;
    }


    public function UpdateUser($userId, $email, $password, $firstname, $lastname) {
        require ('./php/DB/DBManager.php');
        $requete = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET email = ?, password = ?, firstname = ?, lastname = ? WHERE id = ?");
        $response= $requete->execute([$email, $password, $firstname, $lastname, $userId]);
        return $response;
    }


    public function DeleteUser($userId) {
        require ('./php/DB/DBManager.php');
        $requete = $bdd->prepare("DELETE FROM " . $this::TABLE_NAME . " WHERE id = ?");
        $response= $requete->execute([$userId]);
        return $response;
    }
}
    
    //  inscrire un utilisateur
    // role en dernier car optionnel

   




?>