<?php 

$data = json_decode(file_get_contents('php://input'), true);
$image_id = $data['image_id'];

require_once('../Classes/Images.php');

use Classes\Images;

$myImg = new Images();

$deleteImg = $myImg->deleteRow($image_id);
