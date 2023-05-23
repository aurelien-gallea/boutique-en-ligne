<?php

require ('./php/DB/DBManager.php');


require ('./php/Classes/User.php');

use Classes\User; 

$user = new User();

$requete = $user->CreateUser('test@gmail.com', 'bonjour', 'test', 'test');
var_dump($requete);
