<?php

namespace Classes; 
use PDO;

class Carriers {

    const TABLE_NAME = "carriers";

    private $_id;
    private $_name;
    private $_description;
    private $_price;
    
    public function __construct()
    {
        
        $this->_id = null;
        $this->_name = "";
        $this->_description = "";
        $this->_price = null;
       
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

    // description
    public function getDescription() : string {
        return $this->_description;
    }
    public function setDescription(string $newDescription) : string {
        return $this->_description = $newDescription;
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

    public function add($name, $description, $price) {
        require('../DB/DBManager.php');
        $formatPrice = number_format($price, 2, '.', '');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, description, price) VALUES (?,?,?)");
        $request->execute([$this->setName($name), $this->setDescription($description), $this->setPrice($formatPrice)]);
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

    public function updateDescription($description, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET description = ?  WHERE id = ? ");
         $request->execute([$this->setDescription($description),$id]);
        return $request;

    }

    public function updatePrice($price,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price = ?  WHERE id = ? ");
         $request->execute([$this->setPrice($price),$id]);
        return $request;

    }
}