<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;
class Size { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $_id;
    private $_value;
    
    const TABLE_NAME = "size"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->_id;
        $this->_value;
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
    public function getValue() {
        return $this->_value;
    }
    public function setValue($newValue) {
        return $this->_value = $newValue;
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

    public function addNew(string $value) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (value) VALUES (?)");
        $request->execute([$this->setValue($value)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    public function updateValue($value, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET value = ?  WHERE id = ? ");
         $request->execute([$this->setValue($value),$id]);
        return $request;

    }
}