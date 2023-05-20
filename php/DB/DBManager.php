<?php
    try{
        $dsn = "mysql:host=localhost;dbname=e_commerce;charset=utf8";
        $username = "root";
        $password= "";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $bdd = new PDO($dsn, $username, $password, $options);
        echo 'connexion réussi';
    }catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
?>
