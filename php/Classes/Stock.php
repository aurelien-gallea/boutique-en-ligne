<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;
class Stock { // Déclaration de la classe User qui hérite de la classe DBManager
    
    private $_id;
    private $_product_id;
    private $_size_id;
    private $_color_id;
    private $_images_id;
    private $_price_id;
    private $_quantity;
    
    const TABLE_NAME = "stock"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"
    
    public function __construct() {
        
        $this->_id;
        $this->_product_id;
        $this->_size_id;
        $this->_color_id;
        $this->_images_id;
        $this->_price_id;
        $this->_quantity;
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

    // product_id
    public function getProduct_id() {
        return $this->_product_id;
    }
    public function setProduct_id($newProduct_id) {
        return $this->_product_id = $newProduct_id;
    }
    
    // size_id
    public function getSize_id() {
        return $this->_size_id;
    }
    public function setSize_id($newSize_id) {
        return $this->_size_id = $newSize_id;
    }

    // color_id
    public function getColor_id() {
        return $this->_color_id;
    }
    public function setColor_id($newColor_id) {
        return $this->_color_id = $newColor_id;
    }

     // image_id
     public function getImages_id() {
        return $this->_images_id;
    }
    public function setImages_id($newImages_id) {
        return $this->_images_id = $newImages_id;
    }

    // price_id
    public function getPrice_id() {
        return $this->_price_id;
    }
    public function setPrice_id($newPrice_id) {
        return $this->_price_id = $newPrice_id;
    }

    // Quantity
    public function getQuantity() {
        return $this->_quantity;
    }
    public function setQuantity($newQuantity) {
        return $this->_quantity = $newQuantity;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;  
        
    }

    // obtenir le chemin de l'image correspondant au produit
    public function getallWithImagesInfo() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." INNER JOIN images on images.id = ".$this::TABLE_NAME.".images_id");
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

    // recuperer tout le stock par id de produit
    public function getByProductId($productId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE product_id = ? ");
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

    public function addNew($productId, $sizeId, $colorId, $priceId, $quantity) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (product_id, size_id, color_id, price_id, quantity) VALUES (?,?,?,?,?)");
        $request->execute([$this->setProduct_id($productId), $this->setSize_id($sizeId), $this->setColor_id($colorId), $this->setPrice_id($priceId), $this->setQuantity($quantity)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    // product_id
    public function updateProductId($productId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET product_id = ?  WHERE id = ? ");
         $request->execute([$this->setProduct_id($productId),$id]);
        return $request;

    }

    // size_id
    public function updateSizeId($sizeId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET size_id = ?  WHERE id = ? ");
         $request->execute([$this->setSize_id($sizeId),$id]);
        return $request;

    }

    // color_id
    public function updateColorId($colorId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET color_id = ?  WHERE id = ? ");
         $request->execute([$this->setColor_id($colorId),$id]);
        return $request;

    }

     // color_id
     public function updateImagesId($imageId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET images_id = ?  WHERE id = ? ");
         $request->execute([$this->setImages_id($imageId),$id]);
        return $request;

    }

    // price_id
    public function updatePriceId($priceId, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price_id = ?  WHERE id = ? ");
         $request->execute([$this->setPrice_id($priceId),$id]);
        return $request;

    }

    // quantity
    public function updateQuantity($quantity, $id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET quantity = ?  WHERE id = ? ");
         $request->execute([$this->setQuantity($quantity),$id]);
        return $request;

    }
}