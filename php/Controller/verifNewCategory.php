<?php

use Classes\Categories;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

if(isset($_POST['valider'])){
    if(empty($_POST['name'])){
        echo "Il faut rentrer un nom de catégorie";
    }else{
        $newCategory = new Categories();
        $newCategory->add($_POST['name']);
        header('location: http://localhost/e-commerce/admin/iframe/allCategories.php');
    }
}