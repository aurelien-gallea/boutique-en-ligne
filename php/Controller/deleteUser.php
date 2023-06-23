<?php 

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\User;

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];
$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

$myUser = new User();

$deleteUser = $myUser->deleteUser($user_id);

header('location: '.$destination.'/admin/iframe/allUsers.php');

$response = array('success' => true);
echo json_encode($response);



?>