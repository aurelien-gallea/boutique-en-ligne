<?php
session_start();

require_once('../Classes/User.php');

$userId = $_SESSION['userId'];

use Classes\User;

// Récupérer les données envoyées depuis la requête fetch POST
$data = json_decode(file_get_contents('php://input'), true);

$firstname  = htmlspecialchars($data['firstname']);
$lastname   = htmlspecialchars($data['lastname']);
$pass       = htmlspecialchars($data['password']);
$email      = $_SESSION['email'];

$me = new User();
$myProfile = $me->getById($userId);

$hachedPassword = $me->passVerify($email, $pass);

if ($hachedPassword !== false) {

if ($myProfile['firstname'] !== $firstname) {
    $me->updateFirstname($firstname, $userId);
    $_SESSION['firstname'] = $firstname;
} 
    
if ($myProfile['lastname'] !== $lastname) {
    $me->updateLastname($lastname, $userId);
    $_SESSION['lastname'] = $lastname;
} 
$passwordCorrect = true;
}  else {
    $passwordCorrect = false;
} 

// Répondre avec une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('correct' => $passwordCorrect );
echo json_encode($response);
?>
