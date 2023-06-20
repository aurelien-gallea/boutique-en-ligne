<?php 

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
// echo json_encode($product_id);

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Products;
use Classes\Prod_cat;

$myProd = new Products();
$myProd_cat = new Prod_cat();

$deleteRowProd_cat = $myProd_cat->deleteProduct_id($product_id);
$deleteProd = $myProd->deleteRow($product_id);
header('location: http://localhost/e-commerce/admin/iframe/allProducts.php');

$response = array('success' => true);
echo json_encode($response);



?>