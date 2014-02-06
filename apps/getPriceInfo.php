<?php
include_once('databaseConnection.php');

// Create a new databaseConnection Instance in order to get the database connection info
$databaseConnection = databaseConnection::getInstance();
// Get the databse connection info
$databaseInfo = $databaseConnection->getDatabaseInfo();
// Connect to the database with mysqli
$db = new mysqli($databaseInfo['host'], $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['db']);

$id = $_GET['id'];

$price_list = $db->query("
    SELECT
        price,
        insert_date
    FROM
        market_prices
    WHERE
        type_id = '$id' and
        lowest_check = 'N'
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