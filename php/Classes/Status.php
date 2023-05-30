<?php

namespace Classes;
use PDO;

class status {

    const TABLE_NAME = "status";
    
    private $_id;
    private $_name;

    public function __construct()
    {
        $this->_id;
        $this->_name;
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

    public function addNew($name) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (name) VALUES (?)");
        $request->execute([$this->setName($name)]);
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
}