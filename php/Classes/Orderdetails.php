<?php

namespace Classes;
require_once("SearchByUser_id.php");
use Classes\SearchByUser_id;
use PDO;

class Orderdetails extends SearchByUser_id
{

    const TABLE_NAME = "orderdetails";

    private $_id;
    private $_deliveryFullAddress;
    private $_carriersDetails;
    private $_carriers_price;
    private $_user_id;
    private $_dateCreation;

    public function __construct()
    {
        $this->_id;
        $this->_deliveryFullAddress;
        $this->_carriersDetails;
        $this->_carriers_price;
        $this->_user_id;
        $this->_dateCreation;
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



    // deliveryFullAdress
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
    // user_id
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

    // une seule commande en cours possible
    public function alreadyAdded($user_id) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE user_id = ?"); 
        $request->execute([ $this->setUser_id($user_id)]); 
        return $request->rowCount(); // Retourne le nombre de lignes affectées par la requête, indiquant ainsi le nombre de résultats correspondant à l'email
    }
    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($deliveryFullAddress, $carriersDetails, $carriers_price, $user_id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO " . $this::TABLE_NAME . " (deliveryFullAddress, carriersDetails, carriers_price, user_id) VALUES (?,?,?,?)");
        $request->execute([ 
        $this->setdeliveryFullAddress($deliveryFullAddress),
        $this->setCarriersDetails($carriersDetails),
        $this->setCarriers_price($carriers_price),
        $this->setUser_id($user_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function deleteRow($user_id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM " . $this::TABLE_NAME . " WHERE user_id = ? ");
        $request->execute([$user_id]);
        return $request;
    }

    // delivery address
    public function updateDeliveryFullAddress($newDeliveryFullAddress, $user_id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET deliveryFullAddress = ?  WHERE user_id = ? ");
        $request->execute([$this->setDeliveryFullAddress($newDeliveryFullAddress), $user_id]);
        return $request;
    }

    // carriersDetails
    public function updateCarriersDetails($newCarriersDetails, $user_id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET carriersDetails = ?  WHERE user_id = ? ");
        $request->execute([$this->setCarriersDetails($newCarriersDetails), $user_id]);
        return $request;
    }

    // carriers_price
    public function updateCarriers_price($newCarriers_price, $user_id)
    {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET carriers_price = ?  WHERE user_id = ? ");
        $request->execute([$this->setCarriers_price($newCarriers_price), $user_id]);
        return $request;
    }
}
