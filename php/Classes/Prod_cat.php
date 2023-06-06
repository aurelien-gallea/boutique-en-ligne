<?php

namespace Classes; 
require_once("SearchByProduct_id.php");
use Classes\SearchByProduct_id;
use PDO;

class Prod_cat extends SearchByProduct_id {

    const TABLE_NAME = "products_categories";

    private $_id;
    private $_product_id; //FK
    private $_category_id; //FK

    public function __construct()
    {
        
        $this->_id = null;
        $this->_product_id = null;
        $this->_category_id = null;
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

    // product_id

    public function getProduct_id() {
        return $this->_product_id;
    }
    public function setProduct_id($newProduct_id) {
        return $this->_product_id = $newProduct_id;
    }

    // category_id
    public function getCategory_id() {
        return $this->_category_id;
    }
    public function setCategory_id($newCategory_id) {
        return $this->_category_id = $newCategory_id;
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
    
    public function getAllProductsByCategory_id($_category_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE category_id = ? ");
        $request->execute([$this->setCategory_id($_category_id)]);
        $response = $request->fetchAll(PDO::FETCH_CLASS);
        return json_encode($response);
        
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($product_id, $_category_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (product_id, category_id) VALUES (?,?)");
        $request->execute([$this->setProduct_id($product_id), $this->setCategory_id($_category_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteProduct_id($product_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE product_id = ? ");
        $request->execute([$product_id]);
        return $request;

    }

    public function deleteCategory_id($category_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE category_id = ? ");
        $request->execute([$category_id]);
        return $request;

    }
}