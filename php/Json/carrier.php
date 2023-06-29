<?php
session_start();

require_once('../Classes/Carriers.php');

use Classes\Carriers;

$myCarrier = new Carriers();

$carriers = $myCarrier->getById($_SESSION['carrierID']);

echo(json_encode($carriers));