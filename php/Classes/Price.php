<?php

namespace Classes; 
require_once("SearchByProduct_id.php");
use PDO;
class Price extends SearchByProduct_id {

    const TABLE_NAME = "price";

    private $_id;
    private $_price;
    private $_product_id; //FK

    public function __construct()
    {
        $this->_id = null;
        $this->_price;
        $this->_product_id = null;
        
    }

    // id
    public function getId() : ?int {
        return $this->_id;
    }
    public function setId($id) 
    {
        return $this->_id = $id;
    }

    // price
    public function getPrice() : ?float {
        return $this->_price;
    }
    public function setPrice(?float $newPrice) : ?float {
       return $this->_price = $newPrice; 
    }

    // product_id
    public function getProduct_id() {
        return $this->_product_id;
    }
    public function setProduct_id($newProduct_id) {
        return $this->_product_id = $newProduct_id;
    }


    // getterSQL : SELECT

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;  
        
    }

    //setterSQL :INSERT INTO

    public function add($price, $product_id){
        require('../DB/DBManager.php');
        $formatPrice = number_format($price, 2, '.', '');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (price, product_id) VALUES (?,?)");
        $request->execute([$this->setPrice($formatPrice), $this->setProduct_id($product_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    public function updatePrice($price, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price = ?  WHERE id = ? ");
        $request->execute([$this->setPrice($price),$id]);
        return $request;

    }
}