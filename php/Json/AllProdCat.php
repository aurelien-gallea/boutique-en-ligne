<?php 

use Classes\Prod_cat;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

require('../DB/DBManager.php');
$request = $bdd->prepare("SELECT pc.category_id, COUNT(p.id) AS product_count 
                            FROM products_categories pc 
                            LEFT JOIN products p ON pc.product_id = p.id 
                            GROUP BY pc.category_id");

$request->execute();
$response = $request->fetchAll(PDO::FETCH_CLASS);
$newJson = json_encode($response);
print_r($newJson);
?>