<?php

namespace Classes;
use PDO;

class SearchByUser_id {

    const TABLE_NAME = "";

    public function getAllByUserId($userId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE user_id = ? ");
        $request->execute([$userId]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response; 
    }

    public function getUserInfo($userId) {
        require('../DB/DBManager.php');
        $request = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." INNER JOIN `user` ON user.id = ".$this::TABLE_NAME.".user_id WHERE user_id = ? ");
        $request->execute([$userId]);
        $response = $request->fetch(PDO::FETCH_ASSOC);
        return $response; 
    }
}
