<?php 

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\User;

$users = new User();
$jsonData = json_encode($users->getAll());
print_r($jsonData);

?>