<?php

use Classes\Carriers;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];

$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

if(isset($_POST['valider'])){
    if(empty($_POST['name'])){
        echo "Il faut rentrer un nom de transporteur";
    }else if(empty($_POST['description'])){
        echo "Il faut rentrer une description du transporteur";
    }else if(empty($_POST['price'])){
        echo "Il faut rentrer un prix pour le transporteur";
    }else{
        $newCategory = new Carriers();
        $newCategory->add($_POST['name'], $_POST['description'], $_POST['price']);
        header('location: '.$destination.'/admin/iframe/allCarriers.php');
    }
}