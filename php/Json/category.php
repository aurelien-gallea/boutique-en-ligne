<?php
session_start();

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Categories;

$myCat = new Categories();

$categories = $myCat->getById($_SESSION['catID']);

echo(json_encode($categories));