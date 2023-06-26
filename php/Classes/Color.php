<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
require_once("SearchByProduct_id.php");
use Classes\SearchByProduct_id;
use PDO;

class Color extends SearchByProduct_id { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $_id;
    private $_color;
    private $_product_id; //FK
    
    const TABLE_NAME = "color"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->_id;
        $this->_color;
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

    // quantity
    public function getColor() {
        return $this->_color;
    }
    public function setColor($newcolor) {
        return $this->_color = $newcolor;
    }

    // product_id
    public function getProduct_id() {
        return $this->_product_id;
    }
    public function setProduct_id($newProduct_id) {
        return $this->_product_id = $newProduct_id;
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

    public function getCountColorByProduct(){
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT product_id, COUNT(*) AS color_count FROM ".$this::TABLE_NAME." GROUP BY product_id");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function getProductIdByColorId($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT product_id FROM ".$this::TABLE_NAME." WHERE id = ?");
        $request->execute([$id]);
        $response = $request->fetch(PDO::FETCH_ASSOC);

        if ($response) {
            return $response['product_id'];
        }

        return null;
    }

    public function findByProductAndColor($product_id, $color){
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE product_id = ? AND color = ?");
        $request->execute([$product_id, $color]);
        $response = $request->fetch(PDO::FETCH_ASSOC);

        if($response) {
            $existingColor = new Color();
            $existingColor->setId($response['id']);
            $existingColor->setColor($response['color']);
            $existingColor->setProduct_id($response['product_id']);
            return $existingColor;
        }

        return null;
        
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function add(string $color, $product_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (color, product_id) VALUES (?,?)");
        $request->execute([$this->setColor($color), $this->setProduct_id($product_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;
    }


    public function updateColor($color, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET color = ?  WHERE id = ? ");
         $request->execute([$this->setColor($color),$id]);
        return $request;

    }
}