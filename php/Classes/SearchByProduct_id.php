<?php

namespace Classes;
use PDO;

// classe parente ne servant qu'à être hérité
class SearchByProduct_id {

    const TABLE_NAME = "";

    public function getAllByProductId($productId) {
        file_exists('../DB/DBManager.php') ? require('../DB/DBManager.php') : require('./php/DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE product_id = ? ");
        $request->execute([$productId]);
        $response = $request->fetchAll(PDO::FETCH_ASSOC);
        return $response; 
    }
}
