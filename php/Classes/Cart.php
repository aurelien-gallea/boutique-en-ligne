<?php

namespace Classes;
require_once("SearchByUser_id.php");
use Classes\SearchByUser_id;
use PDO;


class Cart extends SearchByUser_id {

    const TABLE_NAME = "cart";

    private $_id;
    private $_dateCreation;
    private $_quantity;
    private $_price;
    private $_user_id;

    public function __construct()
    {
        $this->_id;
        $this->_dateCreation;
        $this->_quantity;
        $this->_price;
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

    // quantity
    public function getQuantity() {
        return $this->_quantity;
    }
    public function setQuantity($newQuantity) {
        return $this->_quantity = $newQuantity;
    }

    // price
    public function getPrice() {
        return $this->_price;
    }
    public function setPrice($newPrice) {
        return $this->_price = $newPrice;
    }

    // user_id
    public function getUser_id() {
        return $this->_user_id;
    }
    public function setUser_id($newUser_id) {
        return $this->_user_id = $newUser_id;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_CLASS);
        return $response;   
    }
    
    public function getById($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

     // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($quantity, $price,$user_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (quantity, price, user_id) VALUES (?,?,?)");
        $request->execute([$this->setQuantity($quantity), $this->setPrice($price), $this->setUser_id($user_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    // quantity
    public function updateQuantity($qty,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET quantity = ?  WHERE id = ? ");
          $request->execute([$this->setQuantity($qty),$id]);
        return $request;

    }

    // price
    public function updatePrice($price,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price = ?  WHERE id = ? ");
         $request->execute([$this->setPrice($price),$id]);
        return $request;

    }

    // user_id
    public function updateUser_id($newUser_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET user_id = ?  WHERE id = ? ");
        $request->execute([$this->setUser_id($newUser_id),$id]);
        return $request;

    }
}