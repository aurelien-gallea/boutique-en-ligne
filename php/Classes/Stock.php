<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;
class Stock { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $_id;
    private $_quantity;
    private $_size_id;
    
    const TABLE_NAME = "stock"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->_id;
        $this->_quantity;
        $this->_size_id;
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

    // Quantity
    public function getQuantity() {
        return $this->_quantity;
    }
    public function setQuantity($newQuantity) {
        return $this->_quantity = $newQuantity;
    }
    
    // size_id
    public function getSize_id() {
        return $this->_size_id;
    }
    public function setSize_id($newSize_id) {
        return $this->_size_id = $newSize_id;
    }


    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;  
        
    }

    public function getTotalQuantityBySizeId($size_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT SUM(quantity) AS total_quantity FROM stock WHERE size_id = ?");
        $request->execute([$size_id]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response['total_quantity'];
    }

    // obtenir le chemin de l'image correspondant au produit
    public function getallWithImagesInfo() {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');

        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." INNER JOIN images on images.id = ".$this::TABLE_NAME.".images_id");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function getById($id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');

        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    //  inner join multiple

    // recuperer tout le stock par id de produit avec la valeur des couleurs
    public function getAllInfosByProductId($productId) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');

        $request = $bdd->prepare("SELECT ".$this::TABLE_NAME.".quantity, color.colorName AS color, size.sizeName AS size, price.value AS price FROM ".$this::TABLE_NAME." 
        INNER JOIN `color` ON color.id = ".$this::TABLE_NAME.".color_id 
        INNER JOIN `size` ON size.id = ".$this::TABLE_NAME.".size_id 
        INNER JOIN `price` ON price.id = ".$this::TABLE_NAME.".price_id WHERE product_id = ? ");
        $request->execute([$productId]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    // alerte en cas de rupture
    public function getAlertOutOfStock() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE quantity = 0 ");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    // alerte en cas de stock limité
    public function getAlertLimited($quantity) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE quantity < ? ");
        $request->execute([$quantity]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }

    

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function add($quantity, $sizeId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (quantity, size_id) VALUES (?,?)");
        $request->execute([$this->setQuantity($quantity), $this->setSize_id($sizeId)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    // // product_id
    // public function updateProductId($productId, $id) {
    //     require('../DB/DBManager.php');
    //     $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET product_id = ?  WHERE id = ? ");
    //      $request->execute([$this->setProduct_id($productId),$id]);
    //     return $request;

    // }

    // size_id
    public function updateSizeId($sizeId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET size_id = ?  WHERE id = ? ");
         $request->execute([$this->setSize_id($sizeId),$id]);
        return $request;

    }

    // // color_id
    // public function updateColorId($colorId, $id) {
    //     require('../DB/DBManager.php');
    //     $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET color_id = ?  WHERE id = ? ");
    //      $request->execute([$this->setColor_id($colorId),$id]);
    //     return $request;

    // }

    //  // color_id
    //  public function updateImagesId($imageId, $id) {
    //     require('../DB/DBManager.php');
    //     $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET images_id = ?  WHERE id = ? ");
    //      $request->execute([$this->setImages_id($imageId),$id]);
    //     return $request;

    // }

    // // price_id
    // public function updatePriceId($priceId, $id) {
    //     require('../DB/DBManager.php');
    //     $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price_id = ?  WHERE id = ? ");
    //      $request->execute([$this->setPrice_id($priceId),$id]);
    //     return $request;

    // }

    // // quantity
    // public function updateQuantity($quantity, $id) {
    //     require('../DB/DBManager.php');
    //     $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET quantity = ?  WHERE id = ? ");
    //      $request->execute([$this->setQuantity($quantity),$id]);
    //     return $request;

    // }
}