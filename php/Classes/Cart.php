<?php

namespace Classes;
require_once("SearchByUser_id.php");
use Classes\SearchByUser_id;
use PDO;


class Cart extends SearchByUser_id {

    const TABLE_NAME = "cart";

    private $_id;
    private $_createdAt;
    private $_product_id;
    private $_color_id;
    private $_size_id;
    private $_quantity;
    private $_price_id;
    private $_user_id;

    public function __construct()
    {
        $this->_id;
        $this->_createdAt;
        $this->_product_id;
        $this->_color_id;
        $this->_size_id;
        $this->_quantity;
        $this->_price_id;
        $this->_user_id;
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
    public function setProduct_id($product_id) 
    {
        return $this->_product_id = $product_id;
    }
    // color_id
    public function getColor_id() {
        return $this->_color_id;
    }
    public function setColor_id($color_id) 
    {
        return $this->_color_id = $color_id;
    }
    // size_id
    public function getSize_id() {
        return $this->_size_id;
    }
    public function setSize_id($size_id) 
    {
        return $this->_size_id = $size_id;
    }
    // quantity
    public function getQuantity() {
        return $this->_quantity;
    }
    public function setQuantity($newQuantity) {
        return $this->_quantity = $newQuantity;
    }
    // price_id
    public function getPrice_id() {
        return $this->_price_id;
    }
    public function setPrice_id($newPrice_id) {
        return $this->_price_id = $newPrice_id;
    }
    // user_id
    public function getUser_id() {
        return $this->_user_id;
    }
    public function setUser_id($newUser_id) {
        return $this->_user_id = $newUser_id;
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
        
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function productAlreadyAdded($product_id, $color_id, $size_id, $user_id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE product_id = ? AND color_id = ? AND size_id = ? AND user_id = ?"); 
        $request->execute([$this->setProduct_id($product_id), $this->setColor_id($color_id), $this->setSize_id($size_id), $this->setUser_id($user_id)]); // Exécution de la requête préparée en remplaçant le paramètre "?" par la valeur de $email
        return $request->rowCount(); // Retourne le nombre de lignes affectées par la requête, indiquant ainsi le nombre de résultats correspondant à l'email
    }
    
    public function getQtyByRow($product_id, $color_id, $size_id, $user_id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT `quantity`, `id` FROM ".$this::TABLE_NAME." WHERE product_id = ? AND color_id = ? AND size_id = ? AND user_id = ?");
        $request->execute([$this->setProduct_id($product_id), $this->setColor_id($color_id), $this->setSize_id($size_id), $this->setUser_id($user_id)]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response;   
    }

    // avoir toutes les informations du panier avec le nom des valeurs de chaque id
    public function getRowAllInfosByUserId($product_id, $color_id, $size_id, $price_id, $quantity, $user_id) {
        
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT ".$this::TABLE_NAME.".id, ".$this::TABLE_NAME.".product_id AS productId, ".$this::TABLE_NAME.".quantity,
         ".$this::TABLE_NAME.".user_id AS userId, products.name AS productName, color.id AS colorId, color.color AS color, 
         size.id AS sizeId, size.size AS size, images.id AS imageId, images.path AS imagePath, price.id AS priceId, price.price
         FROM ".$this::TABLE_NAME." 
        INNER JOIN `products` ON products.id = ".$this::TABLE_NAME.".product_id
         INNER JOIN `price` ON price.id = ".$this::TABLE_NAME.".price_id 
         INNER JOIN `color` ON color.id = ".$this::TABLE_NAME.".color_id
          INNER JOIN `size` ON size.id = ".$this::TABLE_NAME.".size_id
          INNER JOIN `images` ON images.product_id = ".$this::TABLE_NAME.".product_id 
          WHERE ".$this::TABLE_NAME.".product_id = ? 
          AND ".$this::TABLE_NAME.".color_id = ? 
          AND ".$this::TABLE_NAME.".size_id = ?
          AND ".$this::TABLE_NAME.".price_id = ? 
          AND ".$this::TABLE_NAME.".quantity = ? 
          AND ".$this::TABLE_NAME.".user_id = ? 
          GROUP BY cart.product_id");
        $request->execute([$this->setProduct_id($product_id), $this->setColor_id($color_id), $this->setSize_id($size_id),
         $this->setPrice_id($price_id), $this->setQuantity($quantity), $this->setUser_id($user_id)]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response;
    }
    
     // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($product_id, $color_id, $size_id, $quantity, $price_id,$user_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (product_id, color_id, size_id, quantity, price_id, user_id) VALUES (?,?,?,?,?,?)");
        $request->execute(
            [
            $this->setProduct_id($product_id),
            $this->setColor_id($color_id), 
            $this->setSize_id($size_id),
            $this->setQuantity($quantity), 
            $this->setPrice_id($price_id), 
            $this->setUser_id($user_id)
        ]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    // product_id
    public function updateProduct_id($newProduct_id,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET product_id = ?  WHERE id = ? ");
          $request->execute([$this->setProduct_id($newProduct_id),$id]);
        return $request;
    }
    // color_id
    public function updateColor_id($newColor_id,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET color_id = ?  WHERE id = ? ");
        $request->execute([$this->setColor_id($newColor_id),$id]);
        return $request;
    }
    // size_id
    public function updateSize_id($newSize_id,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET size_id = ?  WHERE id = ? ");
        $request->execute([$this->setSize_id($newSize_id),$id]);
        return $request;
    }
    // quantity
    public function updateQuantity($qty,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET quantity = ?  WHERE id = ? ");
          $request->execute([$this->setQuantity($qty),$id]);
        return $request;

    }

    // price_id
    public function updateprice_id($price_id,$id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET price_id = ?  WHERE id = ? ");
         $request->execute([$this->setPrice_id($price_id),$id]);
        return $request;

    }

    // user_id
    public function updateUser_id($newUser_id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET user_id = ?  WHERE id = ? ");
        $request->execute([$this->setUser_id($newUser_id),$id]);
        return $request;

    }
}