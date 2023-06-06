<?php

namespace Classes;
use PDO;

class OrderFinal {
    
    const TABLE_NAME = "orderfinal";

    private $_id;
    private $_orderDetails_id;
    private $_status_id;
    
    public function __construct()
    {
        $this->_id;
        $this->_orderDetails_id;
        $this->_status_id;
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

    // cart_id
    public function getOrderDetails_id() {
        return $this->_orderDetails_id;
    }

    public function setOrderDetails_id($neworderDetails_id) {
        return $this->_orderDetails_id = $neworderDetails_id;
    }

    // status
    public function getStatus() {
        return $this->_status_id;
    }
    public function setStatus($newStatus_id) 
    {
        return $this->_status_id = $newStatus_id;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;  
        
    }

    // recuperer tout de façon décroissante
    public function getLastOrders() {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME. " ORDER BY DESC");
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

    // getByStatus 
    public function getByStatus($currentStatus_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." INNER JOIN status ON status.id = ".$this::TABLE_NAME.".status_id WHERE status_id = ? ");
        $request->execute([$currentStatus_id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 

    }

    public function getByOrderDetailsId($orderDetailsId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE orderDetails_id = ? ");
        $request->execute([$orderDetailsId]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function getStatusByOrderDetailsId($orderDetailsId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." INNER JOIN `status` ON status.id = ".$this::TABLE_NAME.".status_id WHERE orderDetails_id = ? ");
        $request->execute([$orderDetailsId]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response;  
    }
    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($orderDetails_id, $status_id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (orderDetails_id, status_id) VALUES (?,?)");
        $request->execute([$this->setOrderDetails_id($orderDetails_id), $this->setStatus($status_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
        
    }

    public function deleteRow($id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $request->execute([$id]);
        return $request;

    }

    
    
    // orderDetails_id
    public function updateOrderDetails_id($newOrderDetails_id,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET orderDetails_id = ?  WHERE id = ? ");
        $request->execute([$this->setOrderDetails_id($newOrderDetails_id),$id]);
        return $request;

    }

    // status
    public function updateStatus($newStatus,$id) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET status_id = ?  WHERE id = ? ");
        $request->execute([$this->setStatus($newStatus),$id]);
        return $request;

    }

    

}