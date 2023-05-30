<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;
class User { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $id;
    public $email;
    public $password;
    public $firstname; 
    public $lastname; 
    private $role;
    
    const TABLE_NAME = "user"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->email;
        $this->password;
        $this->firstname;
        $this->lastname;
        $this->role;
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
    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    // Méthodes sql

    /**
     * Vérifie si l'email est disponible dans la table user
     * @param string $email L'email à vérifier
     * @return int Le nombre de lignes correspondant à l'email dans la table user
     */

    public function avalaibleEmail($email) {
        require('../DB/DBManager.php');
        
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE email = ? "); // Préparation d'une requête SQL pour sélectionner toutes les colonnes de la table user où l'email correspond au paramètre fourni
        $request->execute([$email]); // Exécution de la requête préparée en remplaçant le paramètre "?" par la valeur de $email
        return $request->rowCount(); // Retourne le nombre de lignes affectées par la requête, indiquant ainsi le nombre de résultats correspondant à l'email
    }

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
        
    }

    public function getById($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function addNew($email, $password, $firstname, $lastname, $role = "membre") {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO " . $this::TABLE_NAME . " (email, password, firstname, lastname, role) VALUES (?, ?, ?, ?, ?)");
        $request->execute([$email, $password, $firstname, $lastname, $role]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function deleteUser($userId) {
        require ('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM " . $this::TABLE_NAME . " WHERE id = ?");
        $request->execute([$userId]);
        return $request;
    }
        
    // email
    public function updateEmail($email, $id) {
        require ('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET email = ? WHERE id = ?");
        $request->execute([$this->setEmail($email), $id]);
        return $request;
    }

    // password
    public function updatePasword($password, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET password = ?  WHERE id = ? ");
        $request->execute([$this->setPassword($password),$id]);
        return $request;
    }

    // firstname
    public function updateFirstname($firstname, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET firstname = ?  WHERE id = ? ");
         $request->execute([$this->setFirstname($firstname),$id]);
        return $request;

    }

    // lastname
    public function updateLastname($lastname, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET lastname = ?  WHERE id = ? ");
         $request->execute([$this->setLastname($lastname),$id]);
        return $request;

    }

    // role
    public function updateUserRole($newRole, $id) {
        require ('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET role = ? WHERE id = ?");
        $request->execute([$this->setRole($newRole), $id]);
        return $request;

    }  
}


?>