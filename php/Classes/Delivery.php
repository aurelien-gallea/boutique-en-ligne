<?php

namespace Classes; 
require_once("SearchByUser_id.php");
use Classes\SearchByUser_id;
use PDO;

class Delivery extends SearchByUser_id {

    const TABLE_NAME = "delivery";

    private $_id;
    private $_name;
    private $_firstname;
    private $_lastname;
    private $_address;
    private $_postalCode;
    private $_city;
    private $_country;
    private $_phone;
    private $_user_id; //FK

    public function __construct()
    {
        $this->_id;
        $this->_name;
        $this->_firstname;
        $this->_lastname;
        $this->_address;
        $this->_postalCode;
        $this->_city;
        $this->_country;
        $this->_phone;
        $this->_user_id;
    }

    // methodes objet: getters et setters ------------------------------------

    // id
    public function getId() {
        return $this->_id;
    }
    public function setId($id) 
    {
        return $this->_id = $id;
    }

    // name
    public function getName() : string {
        return $this->_name;
    }
    public function setName(string $newName) : string {
       return $this->_name = $newName; 
    }

    // firstname
    public function getFirstName() : string {
        return $this->_firstname;
    }
    public function setFirstName(string $newFirstName) : string {
       return $this->_firstname = $newFirstName; 
    }

    // lastname
    public function getLastName() : string {
        return $this->_lastname;
    }
    public function setLastName(string $newLastName) : string {
       return $this->_lastname = $newLastName; 
    }

    // address
    public function getAddress() : string {
        return $this->_address;
    }
    public function setAddress(string $newAddress) : string {
       return $this->_address = $newAddress; 
    }

    // postal code
    public function getPostalCode() {
        return $this->_postalCode;
    }
    public function setPostalCode($newPostalCode)  {
       return $this->_postalCode = $newPostalCode; 
    }

    // city
    public function getCity() {
        return $this->_city;
    }
    public function setCity($newCity)  {
       return $this->_city = $newCity; 
    }

    // country
    public function getCountry() {
        return $this->_country;
    }
    public function setCountry($newCountry)  {
       return $this->_country = $newCountry; 
    }

    // phone
    public function getPhone() {
        return $this->_phone;
    }
    public function setPhone($newPhone)  {
       return $this->_phone = $newPhone; 
    }

    // user_id
    public function getUser_id() {
        return $this->_user_id;
    }
    public function setUser_id($newUser_id)  {
       return $this->_user_id = $newUser_id; 
    }

     // gettersSQL : SELECT ---------------------------------------------------

     public function getAll() {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
        
    }

    public function getById($id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function avalaibleName($name) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE name = ? "); // Préparation d'une requête SQL pour sélectionner toutes les colonnes de la table user où l'email correspond au paramètre fourni
        $request->execute([$name]); // Exécution de la requête préparée en remplaçant le paramètre "?" par la valeur de $email
        return $request->rowCount(); // Retourne le nombre de lignes affectées par la requête, indiquant ainsi le nombre de résultats correspondant à l'email
    }
    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($name, $firstname, $lastname, $address, $postalCode, $city, $country, $phone, $user_id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, firstname, lastname, address, postalCode, city, country, phone, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
        $request->execute([$this->setName($name), $this->setFirstName($firstname), $this->setLastName($lastname), $this->setAddress($address), $this->setPostalCode($postalCode), $this->setCity($city), $this->setCountry($country), $this->setPhone($phone), $this->setUser_id($user_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }
    
    // name
    public function updateName($name,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET name = ?  WHERE id = ? ");
        $request->execute([$this->setName($name),$id]);
        return $request;

    }

    // firstname
    public function updateFirstName($firstName,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET firstname = ?  WHERE id = ? ");
        $request->execute([$this->setFirstName($firstName),$id]);
        return $request;

    }

    // lastname
    public function updateLastName($lastName,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET lastname = ?  WHERE id = ? ");
        $request->execute([$this->setLastName($lastName),$id]);
        return $request;

    }

    // address
    public function updateAddress($address,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET address = ?  WHERE id = ? ");
        $request->execute([$this->setLastName($address),$id]);
        return $request;

    }

    // postal code
    public function updatePostalCode($postalCode,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET postalCode = ?  WHERE id = ? ");
        $request->execute([$this->setPostalCode($postalCode),$id]);
        return $request;

    }

    // city
    public function updateCity($city,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET city = ?  WHERE id = ? ");
        $request->execute([$this->setCity($city),$id]);
        return $request;

    }

    // country
    public function updateCountry($country,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET country = ?  WHERE id = ? ");
        $request->execute([$this->setCountry($country),$id]);
        return $request;

    }

    // phone
    public function updatePhone($phone,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET phone = ?  WHERE id = ? ");
        $request->execute([$this->setPhone($phone),$id]);
        return $request;

    }

    // user_id
    public function updateUser_id($user_id, $id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET user_$user_id = ?  WHERE id = ? ");
        $request->execute([$this->setUser_id($user_id), $id]);
        return $request;

    }
}