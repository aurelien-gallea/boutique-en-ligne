<?php


    try{
        $dsn = "mysql:host=localhost;dbname=e_commerce;charset=utf8";
        $username = "root";
        $pswd = "root";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $bdd = new PDO($dsn, $username, $pswd, $options);
        // echo 'Connexion réussie';

    }catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
    
?>

