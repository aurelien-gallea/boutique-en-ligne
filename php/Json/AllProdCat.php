<?php 
$data = json_decode(file_get_contents('php://input'), true);
var_dump($data['data']);

// use Classes\Prod_cat;

// spl_autoload_register(function($classes) {
//     require_once('../' .$classes. '.php');
// });

// $prod_cat = new Prod_cat();
// var_dump($data);

// if($data !== null){
//     foreach($data as $id){
//         $result = $prod_cat->getAllProductsByCategory_id($id);
//         echo json_encode($result);
//     }

// }

// print_r($prod_cat->getAll());

// print_r($prod_cat->getAllProductsByCategory_id($_POST['data']));
?>