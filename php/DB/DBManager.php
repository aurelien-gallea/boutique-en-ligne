<?php

namespace DB;
use PDO;
use PDOException;

class DBManager {

protected function connection () {
    try{
        $dsn = "mysql:host=localhost;dbname=e_commerce;charset=utf8";
        $username = "root";
        $password= "";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $bdd = new PDO($dsn, $username, $password, $options);

    }catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
    return $bdd;
}

}
