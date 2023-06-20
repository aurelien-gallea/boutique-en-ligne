<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;
class User { 
    
    private $_id;
    private $_email;
    private $_password;
    private $_firstname; 
    private $_lastname; 
    private $_role;
    
    const TABLE_NAME = "user"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        $this->_id;
        $this->_email;
        $this->_password;
        $this->_firstname;
        $this->_lastname;
        $this->_role;
    }

    // Getter et Setter de l'attribut $id
    public function getId() {
        return $this->_id;
    }


    public function setId($newId) {
        return $this->_id = $newId;
    }

    // Getter et Setter de l'attribut $email
    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($newEmail) {
        return $this->_email = $newEmail;
    }


    // Getter et Setter de l'attribut $password
    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($newPassword) {
        return $this->_password = $newPassword;
    }

    // Getter et Setter de l'attribut $firstname
    public function getFirstname() {
        return $this->_firstname;
    }

    public function setFirstname($newFirstname) {
        return $this->_firstname = $newFirstname;
    }

    // Getter et Setter de l'attribut $lastname
    public function getLastname() {
        return $this->_lastname;
    }

    public function setLastname($newLastname) {
        return $this->_lastname = $newLastname;
    }

    // Getter et Setter de l'attribut $role
    public function getRole() {
        return $this->_role;
    }

    public function setRole($newRole) {
        return $this->_role = $newRole;
    }

    // Méthodes sql

    /**
     * Vérifie si l'email est disponible dans la table user
     * @param string $email L'email à vérifier
     * @return int Le nombre de lignes correspondant à l'email dans la table user
     */

    public function avalaibleEmail($email) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
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
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function addNew($email, $pass, $firstname, $lastname, $role = "membre") {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (email, password, firstname, lastname, role) VALUES (?, ?, ?, ?, ?)");
        $request->execute([$this->setEmail($email), $this->setPassword($pass), $this->setFirstname($firstname), $this->setLastname($lastname), $this->setRole($role)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function passVerify($email, $pass) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT `password` FROM ".$this::TABLE_NAME." WHERE email = ?");
        $request->execute([$this->setEmail($email)]);
        $row = $request->fetch();
        
        return $row && password_verify($pass, $row['password']) ? $row['password'] : false;
       
    }  
    public function connection($email, $hachedPassword) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE email = ? AND password = ?");
        $request->execute([$this->setEmail($email), $this->setPassword($hachedPassword)]);
        $response = $request->fetch();
        return $response;
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
    public function updatePassword($password, $id) {
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

