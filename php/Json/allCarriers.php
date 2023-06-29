<?php

require_once('../Classes/Carriers.php');

use Classes\Carriers;

$carriers = new Carriers();
$jsonData = json_encode($carriers->getAll());
print_r($jsonData);
?>