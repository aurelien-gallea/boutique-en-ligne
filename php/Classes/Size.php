<?php

namespace Classes; // Déclaration de l'espace de noms "Classes"
use PDO;

class Size
{ // Déclaration de la classe User qui hérite de la classe DBManager

    private $_id;
    private $size;
    private $_color_id; //FK

    const TABLE_NAME = "size"; // Déclaration d'une constante de classe appelée TABLE_NAME avec la valeur "user"

    public function __construct()
    {

        $this->_id;
        $this->size;
        $this->_color_id;
    }

    // methodes objet: getters et setters ------------------------------------

    // id
    public function getId()
    {
        return $this->_id;
    }
    public function setId($id)
    {
        return $this->_id = $id;
    }


    public function getSize()
    {
        return $this->size;
    }
    public function setSize($newSize)
    {
        return $this->size = $newSize;
    }

    // color_id
    public function getColor_id()
    {
        return $this->_color_id;
    }
    public function setColor_id($newColor_id)
    {
        return $this->_color_id = $newColor_id;
    }

    // gettersSQL : SELECT ---------------------------------------------------

    public function getAll()
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME);
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function getById($id)
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME . " WHERE id = ? ");
        $request->execute([$id]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function getByColorId($colorId)
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME . " WHERE color_id = ? ");
        $request->execute([$colorId]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function getCountSizeByColor()
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT color_id, COUNT(*) AS size_count FROM " . $this::TABLE_NAME . " GROUP BY color_id");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function findByColorAndSize($colorId, $size)
    {
        require('../DB/DBManager.php');

        $request = $bdd->prepare("SELECT * FROM " . $this::TABLE_NAME . " WHERE color_id = :colorId AND size = :size");
        $request->bindParam(':colorId', $colorId);
        $request->bindParam(':size', $size);
        $request->execute();
        $response = $request->fetch(PDO::FETCH_ASSOC);

        if ($response) {
            $sizeInstance = new Size();
            $sizeInstance->setId($response['id']);
            $sizeInstance->setColor_id($response['color_id']);
            $sizeInstance->setSize($response['size']);

            return $sizeInstance;
        } else {
            return null;
        }
    }

    public function findBySize($size) {
        require('../DB/DBManager.php');
    
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE size = ?");
        $request->execute([$size]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
    
        if ($response) {
            $sizeInstance = new Size();
            $sizeInstance->setId($response['id']);
            $sizeInstance->setColor_id($response['color_id']);
            $sizeInstance->setSize($response['size']);
    
            return $sizeInstance;
        } else {
            return null;
        }
    }
    
    // settersSQL : INSERT INTO / UPDATE / DELETE ---------------------------


    public function add($size, $color_id)
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("INSERT INTO " . $this::TABLE_NAME . " (size, color_id) VALUES (?,?)");
        $request->execute([$this->setSize($size), $this->setColor_id($color_id)]);
        $lastId = $bdd->lastInsertId();
        return $this->setId($lastId);
    }

    public function deleteRow($id)
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("DELETE FROM " . $this::TABLE_NAME . " WHERE id = ? ");
        $request->execute([$id]);
        return $request;
    }


    public function updateSizeName($size, $id)
    {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("UPDATE " . $this::TABLE_NAME . " SET size = ?  WHERE id = ? ");
        $request->execute([$this->setsize($size), $id]);
        return $request;
    }
}
