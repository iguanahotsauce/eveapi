<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('eveMarketAPI.php');
// Create a new instance of eveMarketAPI
$eveMarketAPI = eveMarketAPI::getInstance();
// Get the typeid list
$typeids = $eveMarketAPI->getTypeIDs('2');
$types = array('BUY', 'SELL');
// Loop through each typeid and check the sell orders to see if a new row needs to be inserted into the database
foreach($types as $type) {
	foreach($typeids as $typeid) 
		$eveMarketAPI->getOrders($typeid['type_id'], $typeid['minimum_quantity'], $type);
}