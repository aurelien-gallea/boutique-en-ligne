<?php

namespace Classes; 

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

    // price
    public function getPrice() : ?float {
        return $this->_price;
    }
    public function setPrice(?float $newPrice) : ?float {
        return $this->_price = $newPrice;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        return $request;
        
    }

    public function getById($id) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;
    }

    public function findIdWith($name, $valueName) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT id FROM ".$this::TABLE_NAME." WHERE ".$valueName." = ? ");
        $response = $request->execute([$name]);
        return $response;
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($name, $description, $price) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name, description, price) VALUES (?,?,?)");
        $request->execute([$this->setName($name), $this->setDescription($description), $this->setPrice($price)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    public function updateName($name,$id) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET name = ?  WHERE id = ? ");
        $request->execute([$this->setName($name),$id]);
        return $request;

    }

    public function updateDescription($description, $id) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET description = ?  WHERE id = ? ");
         $request->execute([$this->setDescription($description),$id]);
        return $request;

    }

    public function updatePrice($price,$id) {
        require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price = ?  WHERE id = ? ");
         $request->execute([$this->setPrice($price),$id]);
        return $request;

    }
}