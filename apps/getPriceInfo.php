<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('databaseConnection.php');
include_once('eveMarketAPI.php');
date_default_timezone_set('America/Los_Angeles');

if($_GET['id'] == 34) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	
	$eveMarketAPI = eveMarketAPI::getInstance();
	
	$eveMarketAPI->addPageView($ip, $user_agent);
}

// Create a new databaseConnection Instance in order to get the database connection info
$databaseConnection = databaseConnection::getInstance();
// Get the databse connection info
$databaseInfo = $databaseConnection->getDatabaseInfo();
// Connect to the database with mysqli
$db = new mysqli($databaseInfo['host'], $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['db']);

$id = $db->real_escape_string($_GET['id']);

$price_list = $db->query("
    SELECT
        price,
        insert_date
    FROM
        market_prices
    WHERE
        type_id = '$id' and
        type = 'S'
    ORDER BY
    	insert_date asc
");

$price_array = array();
while($info = $price_list->fetch_array()) {
    $price_array[] = array(
    	strtotime($info['insert_date'])*1000,
    	(float)$info['price']
    );
}

echo json_encode($price_array);
exit;
