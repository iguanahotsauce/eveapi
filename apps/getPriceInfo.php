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
        mp.price,
        mp.insert_date,
        mp.quantity,
        (select price from market_prices where type_id = '$id' and type = 'B' order by abs(TIME_TO_SEC(TIMEDIFF(insert_date,mp.insert_date))) limit 1) as buy_price
    FROM
        market_prices mp
    WHERE
        mp.type_id = '$id' and
        mp.type = 'S'
    ORDER BY
    	mp.insert_date asc
");

$price_array = array();
while($info = $price_list->fetch_array()) {
    $price_array['data'][] = array(
    	strtotime($info['insert_date'])*1000,
    	(float)$info['price']
    );
    $price_array['quantity'][strtotime($info['insert_date'])*1000] = (integer)$info['quantity'];
    $price_array['buy_price'][strtotime($info['insert_date'])*1000] = (float)$info['buy_price'];
}

echo json_encode($price_array);
exit;