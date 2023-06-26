<?php

namespace Classes;

require_once("SearchByUser_id.php");

use Classes\SearchByUser_id;
use PDO;

class Orderfinal extends SearchByUser_id
{

    const TABLE_NAME = "orderfinal";

    private $_id;
    private $_deliveryFullAddress;
    private $_carriersDetails;
    private $_carriers_price;
    private $_product_ids;
    private $_color_ids;
    private $_size_ids;
    private $_product_names;
    private $_color_names;
    private $_size_names;
    private $_price_values;
    private $_quantity;
    private $_total_amount;
    private $_payement_status;
    private $_user_id;
    private $_createdAt;

    public function __construct()
    {
        $this->_id;
        $this->_deliveryFullAddress;
        $this->_carriersDetails;
        $this->_carriers_price;
        $this->_product_ids;
        $this->_color_ids;
        $this->_size_ids;
        $this->_product_names;
        $this->_color_names;
        $this->_size_names;
        $this->_price_values;
        $this->_quantity;
        $this->_total_amount;
        $this->_payement_status;
        $this->_user_id;
        $this->_createdAt;
    }

    // methodes objet: getters et setters ------------------------------------

    // id
    public function getId(): ?int
    {
        return $this->_id;
    }
    public function setId($id)
    {
        return $this->_id = $id;
    }

    // deliveryFullAddress
    public function getdeliveryFullAddress()
    {
        return $this->_deliveryFullAddress;
    }

    public function setdeliveryFullAddress($newdeliveryFullAddress)
    {
        return $this->_deliveryFullAddress = $newdeliveryFullAddress;
    }

    // carriersDetails
    public function getCarriersDetails()
    {
        return $this->_carriersDetails;
    }

    public function setCarriersDetails($newCarriersDetails)
    {
        return $this->_carriersDetails = $newCarriersDetails;
    }

    // carriersPrice
    public function getCarriers_price()
    {
        return $this->_carriersDetails;
    }

    public function setCarriers_price($newCarriers_price)
    {
        return $this->_carriers_price = $newCarriers_price;
    }

    // product_ids
    public function getProduct_ids()
    {
        return $this->_product_ids;
    }

    public function setProduct_ids($newProduct_ids)
    {
        return $this->_product_ids = $newProduct_ids;
    }

    // color_ids
    public function getColor_ids()
    {
        return $this->_color_ids;
    }

    public function setColor_ids($newColor_ids)
    {
        return $this->_color_ids = $newColor_ids;
    }

    // size_ids
    public function getSize_ids()
    {
        return $this->_size_ids;
    }

    public function setSize_ids($newSize_ids)
    {
        return $this->_size_ids = $newSize_ids;
    }
    // product_names
    public function getProduct_names()
    {
        return $this->_product_names;
    }

    public function setProduct_names($newProduct_names)
    {
        return $this->_product_names = $newProduct_names;
    }
    // color_names
    public function getColor_names()
    {
        return $this->_product_names;
    }

    public function setColor_names($newColor_names)
    {
        return $this->_color_names = $newColor_names;
    }
    // size_names
    public function getSize_names()
    {
        return $this->_product_names;
    }

    public function setSize_names($newSize_names)
    {
        return $this->_size_names = $newSize_names;
    }
    // price_values
    public function getPrice_values()
    {
        return $this->_price_values;
    }
    public function setPrice_values($newPrice_values)
    {
        return $this->_price_values = $newPrice_values;
    }
    // quantity
    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function setQuantity($newQuantity)
    {
        return $this->_quantity = $newQuantity;
    }

    // total_amount
    public function getTotal_amount()
    {
        return $this->_total_amount;
    }

    public function setTotal_amount($newTotal_amount)
    {
        return $this->_total_amount = $newTotal_amount;
    }

    // payement_status
    public function getPayement_status()
    {
        return $this->_payement_status;
    }

    public function setPayement_status($newPayement_status)
    {
        return $this->_payement_status = $newPayement_status;
    }

    // user_ids
    public function getUser_id()
    {
        return $this->_user_id;
    }

    public function setUser_id($newUser_id)
    {
        return $this->_user_id = $newUser_id;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll()
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function getByUserId($id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME . " WHERE user_id = ? ");
        $request->execute([$id]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response;
    }


    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------
   
    public function addNew($deliveryFullAddress, $carriersDetails, $carriers_price, $product_ids, $color_ids, $size_ids, $product_names, $color_names, $size_names, $price_values, $quantity, $total_amount,$payement_status, $user_id)
    {
        
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO " . $this::TABLE_NAME . " 
        (deliveryFullAddress, carriersDetails, carriers_price, product_ids, color_ids, size_ids, product_names, color_names, size_names, price_values, quantity, total_amount, payement_status, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $request->execute([ 
        $this->setdeliveryFullAddress($deliveryFullAddress),
        $this->setCarriersDetails($carriersDetails),
        $this->setCarriers_price($carriers_price),
        $this->setProduct_ids($product_ids),
        $this->setColor_ids($color_ids),
        $this->setSize_ids($size_ids),
        $this->setProduct_names($product_names),
        $this->setColor_names($color_names),
        $this->setSize_names($size_names),
        $this->setPrice_values($price_values),
        $this->setQuantity($quantity),
        $this->setTotal_amount($total_amount),
        $this->setPayement_status($payement_status),
        $this->setUser_id($user_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function deleteRow($id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM " . $this::TABLE_NAME . " WHERE id = ? ");
        $request->execute([$id]);
        return $request;
    }

    // delivery address
    public function updateDeliveryFullAddress($newDeliveryFullAddress, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET deliveryFullAddress = ?  WHERE id = ? ");
        $request->execute([$this->setDeliveryFullAddress($newDeliveryFullAddress), $id]);
        return $request;
    }

    // carriersDetails
    public function updateCarriersDetails($newCarriersDetails, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET carriersDetails = ?  WHERE id = ? ");
        $request->execute([$this->setCarriersDetails($newCarriersDetails), $id]);
        return $request;
    }

    // carriers_price
    public function updateCarriers_price($newCarriers_price, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET carriers_price = ?  WHERE id = ? ");
        $request->execute([$this->setCarriers_price($newCarriers_price), $id]);
        return $request;
    }

    // product_ids
    public function updateProduct_ids($product_ids, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET product_ids = ?  WHERE id = ? ");
        $request->execute([$this->setProduct_ids($product_ids), $id]);
        return $request;
    }

    // color_ids
    public function updateColor_ids($color_ids, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET color_ids = ?  WHERE id = ? ");
        $request->execute([$this->setColor_ids($color_ids), $id]);
        return $request;
    }

    // size_ids
    public function updateSize_ids($size_ids, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET size_ids = ?  WHERE id = ? ");
        $request->execute([$this->setSize_ids($size_ids), $id]);
        return $request;
    }

    // quantity
    public function updateQuantity($quantity, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET quantity = ?  WHERE id = ? ");
        $request->execute([$this->setQuantity($quantity), $id]);
        return $request;
    }

    // total_amount
    public function updateTotal_amount($total_amount, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET total_amount = ?  WHERE id = ? ");
        $request->execute([$this->setTotal_amount($total_amount), $id]);
        return $request;
    }

    // payement_status
    public function updatePayement_status($payement_status, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET payement_status = ?  WHERE id = ? ");
        $request->execute([$this->setPayement_status($payement_status), $id]);
        return $request;
    }

    // product_names
    public function updateProduct_names($product_names, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET product_names = ?  WHERE id = ? ");
        $request->execute([$this->setProduct_names($product_names), $id]);
        return $request;
    }
    // color_names
    public function updateColor_names($color_names, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET color_names = ?  WHERE id = ? ");
        $request->execute([$this->setColor_names($color_names), $id]);
        return $request;
    }
    // size_names
    public function updateSize_names($size_names, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET size_names = ?  WHERE id = ? ");
        $request->execute([$this->setSize_names($size_names), $id]);
        return $request;
    }
    // price_values
    public function updatePrice_values($price_values, $id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET price_values = ?  WHERE id = ? ");
        $request->execute([$this->setPrice_values($price_values), $id]);
        return $request;
    }
}
