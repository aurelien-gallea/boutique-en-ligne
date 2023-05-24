<?php

namespace Classes; 

class Delivery {

    const TABLE_NAME = "delivery";

    private $_id;
    private $_name;
    private $_firstname;
    private $_lastname;
    private $_adress;
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
        $this->_adress;
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

    // adress
    public function getAdress() : string {
        return $this->_adress;
    }
    public function setAdress(string $newAdress) : string {
       return $this->_adress = $newAdress; 
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
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        return $request;
        
    }

    public function getById($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
         $request->execute([$id]);
        return $request;
    }

    public function findIdWith($name, $valueName) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT id FROM ".$this::TABLE_NAME." WHERE ".$valueName." = ? ");
        $response = $request->execute([$name]);
        return $response;
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($name, $firstname, $lastname, $adress, $postalCode, $city, $country, $phone, $user_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, firstname, lastname, adress, postalCode, city, country, phone, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
        $request->execute([$this->setName($name), $this->setFirstName($firstname), $this->setLastName($lastname), $this->setAdress($adress), $this->setPostalCode($postalCode), $this->setCity($city), $this->setCountry($country), $this->setPhone($phone), $this->setUser_id($user_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }
    
    // name
    public function updateName($name,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET name = ?  WHERE id = ? ");
        $request->execute([$this->setName($name),$id]);
        return $request;

    }

    // firstname
    public function updateFirstName($firstName,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET firstname = ?  WHERE id = ? ");
        $request->execute([$this->setFirstName($firstName),$id]);
        return $request;

    }

    // lastname
    public function updateLastName($lastName,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET lastname = ?  WHERE id = ? ");
        $request->execute([$this->setLastName($lastName),$id]);
        return $request;

    }

    // adress
    public function updateAdress($adress,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET adress = ?  WHERE id = ? ");
        $request->execute([$this->setLastName($adress),$id]);
        return $request;

    }

    // postal code
    public function updatePostalCode($postalCode,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET postalCode = ?  WHERE id = ? ");
        $request->execute([$this->setPostalCode($postalCode),$id]);
        return $request;

    }

    // city
    public function updateCity($city,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET city = ?  WHERE id = ? ");
        $request->execute([$this->setCity($city),$id]);
        return $request;

    }

    // country
    public function updateCountry($country,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET country = ?  WHERE id = ? ");
        $request->execute([$this->setCountry($country),$id]);
        return $request;

    }

    // phone
    public function updatePhone($phone,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET phone = ?  WHERE id = ? ");
        $request->execute([$this->setPhone($phone),$id]);
        return $request;

    }

    // user_id
    public function updateUser_id($user_id, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET user_$user_id = ?  WHERE id = ? ");
        $request->execute([$this->setUser_id($user_id), $id]);
        return $request;

    }
}