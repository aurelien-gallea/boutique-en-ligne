<?php
session_start();

spl_autoload_register(function($classes) {
    require_once('../' .$classes. '.php');
});

use Classes\Carriers;

$myCarrier = new Carriers();

$carriers = $myCarrier->getById($_SESSION['carrierID']);

echo(json_encode($carriers));