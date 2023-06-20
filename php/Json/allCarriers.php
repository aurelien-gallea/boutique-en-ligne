<?php

use Classes\Carriers;

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

$carriers = new Carriers();
$jsonData = json_encode($carriers->getAll());
print_r($jsonData);
?>