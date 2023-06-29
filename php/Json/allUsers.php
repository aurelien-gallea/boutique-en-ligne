<?php 

require_once('../Classes/User.php');

use Classes\User;

$users = new User();
$jsonData = json_encode($users->getAll());
print_r($jsonData);

?>