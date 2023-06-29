<?php

require_once('../Classes/Categories.php');

use Classes\Categories;

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];

$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

if(isset($_POST['valider'])){
    if(empty($_POST['name'])){
        echo "Il faut rentrer un nom de catégorie";
    }else{
        $newCategory = new Categories();
        $newCategory->add($_POST['name']);
        header('location: '.$destination.'/admin/iframe/allCategories.php');
    }
}