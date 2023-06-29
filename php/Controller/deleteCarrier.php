<?php 

$data = json_decode(file_get_contents('php://input'), true);
$carrier_id = $data['carrier_id'];

require_once('../Classes/Carriers.php');

use Classes\Carriers;

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];
$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

$myCarrier = new Carriers();

$deleteCarrier = $myCarrier->deleteRow($carrier_id);

header('location: '.$destination.'/admin/iframe/allCarriers.php');

$response = array('success' => true);
echo json_encode($response);



?>