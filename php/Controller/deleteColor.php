<?php 

$data = json_decode(file_get_contents('php://input'), true);
$color_id = $data['color_id'];

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Color;

$myColor = new Color();

$color = $myColor->deleteRow($color_id);