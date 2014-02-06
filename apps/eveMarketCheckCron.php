<?php
include_once('eveMarketAPI.php');
// Create a new instance of eveMarketAPI
$eveMarketAPI = eveMarketAPI::getInstance();
// Get the typeid list
$typeids = $eveMarketAPI->getTypeIDs();
// Loop through each typeid and check the sell orders to see if a new row needs to be inserted into the database
foreach($typeids as $typeid) 
	$eveMarketAPI->getSellOrders($typeid['type_id'], $typeid['minimum_quantity']);