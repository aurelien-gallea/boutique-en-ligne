<?php 

$data = json_decode(file_get_contents('php://input'), true);
$stock_id = $data['quantity_id'];
$size_id = $data['size_id'];
$color_id = $data['color_id'];

require_once('../Classes/Size.php');

use Classes\Size;

$mySize = new Size();

$deleteSize = $mySize->deleteRow($size_id);