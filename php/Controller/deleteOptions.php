<?php 

$data = json_decode(file_get_contents('php://input'), true);
$stock_id = $data['quantity_id'];
$size_id = $data['size_id'];
$color_id = $data['color_id'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Color;
use Classes\Size;
use Classes\Stock;

$myStock = new Stock();
$mySize = new Size();
$myColor = new Color();


$deleteSize = $mySize->deleteRow($size_id);



