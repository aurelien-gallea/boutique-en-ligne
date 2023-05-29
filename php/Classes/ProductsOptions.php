<?php

namespace Classes; 
require_once("SearchByProduct_id.php");
use Classes\SearchByProduct_id;
use PDO;

class ProductsOptions extends SearchByProduct_id {

    const TABLE_NAME = "productsoptions";

    // private $_db;
    private $_id;
    private $_name;
    private $_value;
    private $_quantity;
    private $_price;
    private $_product_id; //FK

    public function __construct()
    {
        
        $this->_id = null;
        $this->_name = "";
        $this->_value = "";
        $this->_quantity = null;
        $this->_price = null;
        $this->_product_id = null;
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

    // name
    public function getName() : string {
        return $this->_name;
    }
    public function setName(string $newName) : string {
       return $this->_name = $newName; 
    }

    // value
    public function getValue() : string {
        return $this->_value;
    }
    public function setValue(string $newValue) : string {
        return $this->_value = $newValue;
    }

    // quantity
    public function getQuantity() : ?int {
        return $this->_quantity;
    }
    public function setQuantity($qty) : ?int {
        return $this->_quantity = $qty;
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
    public function setProduct_id( ?int $newProduct_id) : ?int {
        return $this->_product_id = $newProduct_id;
    }

    // get totalPrice
    public function getTotalPrice() : ?float {
        return $this->_price * $this->_quantity;
    }

    // gettersSQL : SELECT ---------------------------------------------------

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

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew(string $name, string $value, ?float $price, ?int $quantity, int $product_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, value, price, quantity, product_id) VALUES (?,?,?,?,?)");
        $request->execute([$this->setName($name), $this->setValue($value), $this->setPrice($price), $this->setQuantity($quantity), $this->setProduct_id($product_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    public function updateName($name,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET name = ?  WHERE id = ? ");
        $request->execute([$this->setName($name),$id]);
        return $request;

    }

    public function updateValue($value, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET value = ?  WHERE id = ? ");
         $request->execute([$this->setValue($value),$id]);
        return $request;

    }

    public function updateQuantity($qty,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET quantity = ?  WHERE id = ? ");
          $request->execute([$this->setQuantity($qty),$id]);
        return $request;

    }

    public function updatePrice($price,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price = ?  WHERE id = ? ");
         $request->execute([$this->setPrice($price),$id]);
        return $request;

    }

    public function updateProduct_id($product_id,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET product_id = ?  WHERE id = ? ");
          $request->execute([$this->setProduct_id($product_id),$id]);
        return $request;

    }
}