<?php

namespace Classes;

class OrderFinal {
    
    const TABLE_NAME = "orderfinal";

    private $_id;
    private $_orderDetails_id;
    private $_status;
    
    public function __construct()
    {
        $this->_id;
        $this->_orderDetails_id;
        $this->_status;
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
        return $this->_status;
    }
    public function setStatus($newStatus) 
    {
        return $this->_status = $newStatus;
    }

    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------

    public function addNew($orderDetails_id, $status) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME." (orderDetails, status) VALUES (?,?)");
        $request->execute([$this->setOrderDetails_id($orderDetails_id), $this->setStatus($status)]);
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
        $request = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET status = ?  WHERE id = ? ");
        $request->execute([$this->setStatus($newStatus),$id]);
        return $request;

    }
}