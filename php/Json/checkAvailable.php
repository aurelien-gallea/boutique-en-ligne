<?php
session_start();

require_once('../Classes/User.php');

use Classes\User;

$email = $_POST['email'];

$myUser = new User();

$usedEmail = $myUser->availableEmail($email);

if ($usedEmail > 0) {
    echo("used");
} else {
    echo("available");
}
