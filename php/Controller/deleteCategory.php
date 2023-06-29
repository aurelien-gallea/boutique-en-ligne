<?php 

$data = json_decode(file_get_contents('php://input'), true);
$category_id = $data['category_id'];

require_once('../Classes/Categories.php');
require_once('../Classes/Prod_cat.php');

use Classes\Categories;
use Classes\Prod_cat;


$url = $_SERVER['SCRIPT_FILENAME'];
$path = parse_url($url, PHP_URL_PATH);
$directory = explode('/', $path)[3];
$destination = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$directory;

$myCat = new Categories();
$myProd_cat = new Prod_cat();

$myProd_cat->deleteCategory_id($category_id);
$deleteCat = $myCat->deleteRow($category_id);

header('location: '.$destination.'/admin/iframe/allCategories.php');

$response = array('success' => true);
echo json_encode($response);



?>
