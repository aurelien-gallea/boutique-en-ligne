<?php
session_start();

require_once('../Classes/Categories.php');

use Classes\Categories;

$myCat = new Categories();

$categories = $myCat->getById($_SESSION['catID']);

echo(json_encode($categories));