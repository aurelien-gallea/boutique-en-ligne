<?php

namespace Classes;

class Images {

    const TABLE_NAME = "images";

    private $_id;
    private $_path;
    private $_product_id;
    
    public function __constructor() {
        $this->_id;
        $this->_path;
        $this->_product_id;
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

    // id
    public function getPath() {
        return $this->_path;
    }

    // path
    public function setPath($newPath) 
    {
        return $this->_path = $newPath;
    }

    // product_id
    public function getProduct_id() {
        return $this->_product_id;
    }
    public function setProduct_id($newProduct_id) {
        return $this->_product_id = $newProduct_id;
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($path, $product_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." ($path, $product_id) VALUES (?,?)");
        $request->execute([$this->setPath($path), $this->setProduct_id($product_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }
    
    // path
    public function updatePath($newPath,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET path = ?  WHERE id = ? ");
        $request->execute([$this->setPath($newPath),$id]);
        return $request;

    }

    // product_id
    public function updateProduct_id($newProduct_id, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET product_id = ?  WHERE id = ? ");
        $request->execute([$this->setProduct_id($newProduct_id), $id]);
        return $request;

    }
}