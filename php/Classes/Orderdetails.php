<?php

namespace Classes;
use PDO;

class Orderdetails {
    
    const TABLE_NAME = "orderdetails";

    private $_id;
    private $_cart_id;
    private $_deliveryFullAddress;
    private $_dateCreation;

    public function __construct()
    {
        $this->_id;
        $this->_cart_id;
        $this->_deliveryFullAddress;
        $this->_dateCreation;
    }

     // methodes objet: getters et setters ------------------------------------

    // id
    public function getId() : ?int {
        return $this->_id;
    }
    public function setId($id) 
    {
        return $this->_id = $id;
    }

    // cart_id
    public function getCart_id() {
        return $this->_cart_id;
    }

    public function setCart_id($newCart_id) {
        return $this->_cart_id = $newCart_id;
    }

    // deliveryFullAdress
    public function getdeliveryFullAddress() {
        return $this->_deliveryFullAddress;
    }

    public function setdeliveryFullAddress($newdeliveryFullAddress) {
        return $this->_deliveryFullAddress = $newdeliveryFullAddress;
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

    public function getByCartId($cartId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE cart_id = ? ");
        $request->execute([$cartId]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($cart_id, $deliveryFullAddress) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (cart_id, deliveryFullAddress) VALUES (?,?)");
        $request->execute([$this->setCart_id($cart_id), $this->setdeliveryFullAddress($deliveryFullAddress)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }
    
    // cart id
    public function updateCart_id($newCart_id,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET cart_id = ?  WHERE id = ? ");
        $request->execute([$this->setCart_id($newCart_id),$id]);
        return $request;

    }
    
    // delivery address
    public function updateDeliveryFullAddress($newDeliveryFullAddress,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET deliveryFullAddress = ?  WHERE id = ? ");
        $request->execute([$this->setDeliveryFullAddress($newDeliveryFullAddress),$id]);
        return $request;

    }

}