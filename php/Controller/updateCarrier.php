<?php
session_start();

require_once('../Classes/Carriers.php');

use Classes\Carriers;

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];

$destination = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/" . $directory;


if (isset($_POST['valider'])) {
    if (empty($_POST['name'])) {
        echo 'Vous devez rentrer une catégorie';
    }else if(empty($_POST['description'])){
        echo 'Vous devez remplir la description';
    }else if(empty($_POST['price'])){
        echo 'Vous devez rentrer un prix';
    }else{
        $myCat = new Carriers();
        $myCat->updateCarrier($_SESSION['carrierID'], $_POST['name'], $_POST['description'], $_POST['price']);

        header('location: ' . $destination . '/admin/iframe/allCarriers.php');
    }
}