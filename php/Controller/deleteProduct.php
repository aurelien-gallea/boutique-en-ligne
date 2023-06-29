<?php 

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
// echo json_encode($product_id);

require_once('../Classes/Products.php');
require_once('../Classes/Prod_cat.php');

use Classes\Products;
use Classes\Prod_cat;

$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];

$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

$myProd = new Products();
$myProd_cat = new Prod_cat();

$deleteRowProd_cat = $myProd_cat->deleteProduct_id($product_id);
$deleteProd = $myProd->deleteRow($product_id);

$response = array('success' => true);
echo json_encode($response);
header('location: '.$destination.'/admin/iframe/allProducts.php');



?>