<?php

namespace Classes; 
use PDO;
class Price {

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

    public function getAll(){
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_CLASS);
        return json_encode($response);
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
}