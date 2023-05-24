<?php

namespace Classes; 
use PDO;
class Products {

    const TABLE_NAME = "products";

    private $_id;
    private $_name;
    private $_description;
    private $_subDesc;
    private $_createAt;
    private $_quantity;
    private $_price;

    public function __construct()
    {
        // $this->_db;
        $this->_id = null;
        $this->_name = "";
        $this->_description; // ---------------
        $this->_subDesc; // -------------------
        $this->_createAt; // ------------------
        $this->_quantity = null;
        $this->_price = null;
        
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

    // description
    public function getDescription() : string {
        return $this->_description;
    }
    public function setDescription(string $newDescription) : string {
        return $this->_description = $newDescription;
    }

    // subDesc
    public function getSubDesc() : string {
        return $this->_subDesc;
    }
    public function setSubDesc(string $newSubDesc) : string {
        return $this->_subDesc = $newSubDesc;
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

    
    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        return $request;
        
    }

    public function getAllById($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_CLASS);
        return json_encode($response); 
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($name, $description, $subDesc, $quantity, $price) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, description, subDesc, quantity, price) VALUES (?,?,?,?,?)");
        $request->execute([$this->setName($name), $this->setDescription($description), $this->setSubDesc($subDesc), $this->setPrice($price), $this->setQuantity($quantity)]);
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

    // description
    public function updateDescription($description, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET description = ?  WHERE id = ? ");
         $request->execute([$this->setDescription($description),$id]);
        return $request;

    }

    // subDesc
    public function updateSubDesc($SubDesc, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET subDesc = ?  WHERE id = ? ");
        $request->execute([$this->setSubDesc($SubDesc),$id]);
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

}