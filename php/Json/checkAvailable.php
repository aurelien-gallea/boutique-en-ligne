<?php
session_start();

spl_autoload_register(function ($classes) {
    require_once('../' . $classes . '.php');
});

use Classes\User;

$email = $_POST['email'];

$myUser = new User();

$usedEmail = $myUser->availableEmail($email);

if ($usedEmail > 0) {
    echo("used");
} else {
    echo("available");
}
