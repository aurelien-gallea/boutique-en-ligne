<?php
session_start();

spl_autoload_register(function ($classes) {
    require_once('../' . $classes . '.php');
});

$userId = $_SESSION['userId'];

use Classes\User;

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);

$pass1  = htmlspecialchars($data['pass1']);
$pass2  = htmlspecialchars($data['pass2']);
$pass3  = htmlspecialchars($data['pass3']);
$email  = $_SESSION['email'];

$me = new User();
$myProfile = $me->getById($userId);

$hachedPassword = $me->passVerify($email, $pass1);


if ($hachedPassword !== false) {
    $newPassword = password_hash($pass2, PASSWORD_BCRYPT);
    $me->updatePassword($newPassword, $userId);
    $passwordCorrect = true;
}  else {
    $passwordCorrect = false;
} 

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('correct' => $passwordCorrect );
echo json_encode($response);
?>