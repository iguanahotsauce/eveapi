<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('databaseConnection.php');
include_once('eveMarketAPI.php');

$eveMarketAPI = eveMarketAPI::getInstance();

$typeids = $eveMarketAPI->getTypeIDs();

echo json_encode($typeids);
exit;