<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('databaseConnection.php');
include_once('functions.php');
date_default_timezone_set('America/Los_Angeles');

class eveMarketAPI {

	// Singleton instance.
	private static $instance;
	// Typeids that are stored in the database
	public $typeids1 = array(
		'Tritanium' => array(
			'type_id' => 34,
			'minimum_quantity' => 950000
		),
		'Pyerite' => array(
			'type_id' => 35,
			'minimum_quantity' => 350000
		),
		'Mexallon' => array(
			'type_id' => 36,
			'minimum_quantity' => 100000
		),
		'Isogen' => array(
			'type_id' => 37,
			'minimum_quantity' => 40000
		),
		'Nocxium' => array(
			'type_id' => 38,
			'minimum_quantity' => 7000
		),
		'Zydrine' => array(
			'type_id' => 39,
			'minimum_quantity' => 6500
		),
		'Megacyte' => array(
			'type_id' => 40,
			'minimum_quantity' => 3000
		),
		'PLEX' => array(
			'type_id' => 29668,
			'minimum_quantity' => 1
		)
	);
	
	public $typeids2 = array(
		'Myrmidon' => array(
			'type_id' => 24700,
			'minimum_quantity' => 1
		),
		'Harbinger' => array(
			'type_id' => 24696,
			'minimum_quantity' => 1
		),
		'Drake' => array(
			'type_id' => 24698,
			'minimum_quantity' => 1
		),
		'Veldspar' => array(
			'type_id' => 1230,
			'minimum_quantity' => 385000
		),
		'Concentrted Veldspar' => array(
			'type_id' => 17470,
			'minimum_quantity' => 366000
		),
		'Dense Veldspar' => array(
			'type_id' => 17471,
			'minimum_quantity' => 355000
		),
		'Scordite' => array(
			'type_id' => 1228,
			'minimum_quantity' => 210000
		),
		'Condensed Scordite' => array(
			'type_id' => 17463,
			'minimum_quantity' => 200000
		)
	);
	
	public $typeids3 = array(
		'Massive Scordite' => array(
			'type_id' => 17464,
			'minimum_quantity' => 187000
		),
		'Pyroxeres' => array(
			'type_id' => 1224,
			'minimum_quantity' => 101000
		),
		'Viscous Pyroxeres' => array(
			'type_id' => 17460,
			'minimum_quantity' => 100000
		),
		'Solid Pyroxeres' => array(
			'type_id' => 17459,
			'minimum_quantity' => 97000
		),
		'Plagioclase' => array(
			'type_id' => 18,
			'minimum_quantity' => 95500
		),
		'Azure Plagioclase' => array(
			'type_id' => 17455,
			'minimum_quantity' => 95000
		),
		'Rich Plagioclase' => array(
			'type_id' => 17456,
			'minimum_quantity' => 88000
		),
		'Omber' => array(
			'type_id' => 1227,
			'minimum_quantity' => 58500
		)
	);
	
	public $typeids4 = array(
		'Silvery Omber' => array(
			'type_id' => 17867,
			'minimum_quantity' => 63000
		),
		'Golden Omber' => array(
			'type_id' => 17868,
			'minimum_quantity' => 63000
		),
		'Kernite' => array(
			'type_id' => 20,
			'minimum_quantity' => 23000
		),
		'Luminous Kernite' => array(
			'type_id' => 17452,
			'minimum_quantity' => 24500
		),
		'Fiery Kernite' => array(
			'type_id' => 17453,
			'minimum_quantity' => 23500
		),
		'Jaspet' => array(
			'type_id' => 1226,
			'minimum_quantity' => 13000
		),
		'Pure Jaspet' => array(
			'type_id' => 17448,
			'minimum_quantity' => 12500
		),
		'Pristine Jaspet' => array(
			'type_id' => 17449,
			'minimum_quantity' => 12500
		)
	);
	
	public $typeids5 = array(
		'Hemorphite' => array(
			'type_id' => 1231,
			'minimum_quantity' => 6500
		),
		'Vivid Hemorphite' => array(
			'type_id' => 17444,
			'minimum_quantity' => 7000
		),
		'Radiant Hemorphite' => array(
			'type_id' => 17449,
			'minimum_quantity' => 8000
		)
		'Hedbergite' => array(
			'type_id' => 21,
			'minimum_quantity' => 8000
		),
		'Vitric Hedbergite' => array(
			'type_id' => 17440,
			'minimum_quantity' => 7500
		),
		'Glazed Hedbergite' => array(
			'type_id' => 17441,
			'minimum_quantity' => 7500
		),
		'Gneiss' => array(
			'type_id' => 1229,
			'minimum_quantity' => 4000
		),
		'Iridescent Gneiss' => array(
			'type_id' => 17865,
			'minimum_quantity' => 2500
		)
	);
	
	public $typeids6 = array(
		'Prismatic Gneiss' => array(
			'type_id' => 17866,
			'minimum_quantity' => 5000
		),
		'Dark Ochre' => array(
			'type_id' => 1232,
			'minimum_quantity' => 2500
		),
		'Onyx Ochre' => array(
			'type_id' => 17436,
			'minimum_quantity' => 1000
		),
		'Obsidian Ochre' => array(
			'type_id' => 17437,
			'minimum_quantity' => 3500
		),
		'Crokite' => array(
			'type_id' => 1225,
			'minimum_quantity' => 1500
		),
		'Arkanor' => array(
			'type_id' => 22,
			'minimum_quantity' => 1500
		),
		'Crimson Arkonor' => array(
			'type_id' => 17425,
			'minimum_quantity' => 1500
		),
		'Prime Arkonor' => array(
			'type_id' => 17426,
			'minimum_quantity' => 1500
		),
	);
	
	public $typeids7 = array(
		'Mercoxit' => array(
			'type_id' => 11396,
			'minimum_quantity' => 300
		),
		'Magma Mercoxit' => array(
			'type_id' => 17869,
			'minimum_quantity' => 18
		),
		'Vitreous Mercoxit' => array(
			'type_id' => 17870,
			'minimum_quantity' => 13
		),
		'Condensed Alloy' => array(
			'type_id' => 11739,
			'minimum_quantity' => 1100
		),
		'Crystal Compound' => array(
			'type_id' => 11741,
			'minimum_quantity' => 1000
		),
		'Precious Alloy' => array(
			'type_id' => 11737,
			'minimum_quantity' => 800
		),
		'Sheen Compound' => array(
			'type_id' => 11732,
			'minimum_quantity' => 500
		),
		'Gleaming Alloy' => array(
			'type_id' => 11740,
			'minimum_quantity' => 450
		)
	);
	
	public $typeids8 = array(
		'Lucent Compound' => array(
			'type_id' => 11738,
			'minimum_quantity' => 350
		),
		'Dark Compound' => array(
			'type_id' => 11735,
			'minimum_quantity' => 450
		),
		'Motley Compound' => array(
			'type_id' => 11733,
			'minimum_quantity' => 700
		),
		'Lustering Alloy' => array(
			'type_id' => 11736,
			'minimum_quantity' => 200
		),
		'Glossy Compound' => array(
			'type_id' => 11724,
			'minimum_quantity' => 1000
		),
		'Plush Compound' => array(
			'type_id' => 11725,
			'minimum_quantity' => 100
		),
		'Opulent Compound' => array(
			'type_id' => 11734,
			'minimum_quantity' => 300
		),
		'Heavy Assault Missile Launcher II' => array(
			'type_id' => 25715,
			'minimum_quantity' => 5
		)
	);
	
	public $typeids9 = array(
		'Heavy Missile Launcher II' => array(
			'type_id' => 2410,
			'minimum_quantity' => 5
		),
		'Expanded Cargohold II' => array(
			'type_id' => 1319,
			'minimum_quantity' => 10
		),
		'Scourge Precision Heavy Missile' => array(
			'type_id' => 24513,
			'minimum_quantity' => 12000
		),
		'Scourge Rage Heavy Assault Missile' => array(
			'type_id' => 2679,
			'minimum_quantity' => 18000
		),
		'Scourge Javelin Heavy Assault Missile' => array(
			'type_id' => 24492,
			'minimum_quantity' => 15000
		)
	);
	// Get the instance of eveMarketAPI
	public static function GetInstance(){

    	if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}
	// Return the typeid array so it can be used in other scripts
	public function getTypeIDs($numberSet) {
		return $this->typeids.$numberSet;
	}
	// Get all of the sell orders from the api.eve-central.com
	public function getOrders($typeid, $minimum_quantity, $type) {
		// Use simplexml to create an object of all of the buy and sell orders for the given typeid with the parameters given
		$marketData = simplexml_load_file('http://api.eve-central.com/api/quicklook?typeid='.$typeid.'&setminQ='.$minimum_quantity.'&sethours=1');
		// Get the average market price for the given typeid
		$average = $this->getAveragePrice($typeid, $type);
		
		$orders = array();
		if(strtoupper($type) == 'BUY') {
			// Loop through each of the buy orders to make sure they are not in lowsec
		    foreach($marketData->quicklook->buy_orders->order as $order) {
		    	// If the sell order is not in lowsec then add it to the orders array
		    	if($order->security > .4 && $order->vol_remain > $minimum_quantity && $order->price > $average) {
		    		$time = new DateTime(strtotime((string)$order->reported_time));
		    		$orders[] = array(
		    			'price' => (float)$order->price,
		    			'location' => (string)$order->station_name,
		    			'quantity' => (int)$order->vol_remain,
		    			'reported_time' => $time->format('m-d-Y H:i:s')
		    		);
		    	}
		    }
	    }
	    else {
		    // Loop through each of the sell orders to make sure they are not in lowsec
		    foreach($marketData->quicklook->sell_orders->order as $order) {
		    	// If the sell order is not in lowsec then add it to the sellOrders array
		    	if($order->security > .4 && $order->vol_remain > $minimum_quantity && $order->price < $average) {
		    		$time = new DateTime(strtotime((string)$order->reported_time));
		    		$orders[] = array(
		    			'price' => (float)$order->price,
		    			'location' => (string)$order->station_name,
		    			'quantity' => (int)$order->vol_remain,
		    			'reported_time' => $time->format('m-d-Y H:i:s')
		    		);
		    	}
		    }
	    }
	    // Sort all of the orders by price asc if they are sell orders and price desc if they are buy orders
	    $orders = $this->sortByPrice($orders, $type);
	    // Get the price, quantity, and location of the lowest price if it is for sell orders and highes price for buy orders on the market in highsec
	    $bestPriceLocation = $this->getBestPrice($orders);
	    // Set the typrid in the bestPriceLocation Array
	    $bestPriceLocation['typeid'] = $typeid;
	    // Gets the last entry in the database so we can see if the new lowest price is different
	    $lastDatabaseEntry = $this->getLatestEntry($typeid, $type);
	    // If the new lowest price is different than the last entry into the database then insert the new price into the database
	    if($bestPriceLocation['price'] != $lastDatabaseEntry['price'] && $bestPriceLocation['price'] > 0 && $bestPriceLocation['quantity'] > 0)
	    	$this->insertNewPrice($bestPriceLocation, $type);
	}
	// Gets the average market price for the given typeid from api.eve-central.com
	public function getAveragePrice($typeid, $type) {
		// Get the xml object of the marketstat for the given typeid
		$averageData = simplexml_load_file('http://api.eve-central.com/api/marketstat?typeid='.$typeid);
		// Pull the average market price from the object and make sure it is a float and not a string
		if(strtoupper($type) == 'BUY')
			$average = (float)$averageData->marketstat->type->buy->avg;
		else
			$average = (float)$averageData->marketstat->type->sell->avg;
			
		return $average;
	}
	// Sorts the sell orders by price
	public function sortByPrice($orders, $type) {
	
		$n = sizeof($orders); 
		   
	    for ($i = 1; $i < $n; $i++) {
	        $flag = false;
	        for ($j = $n - 1; $j >= $i; $j--) {
	            if($orders[$j-1]['price'] > $orders[$j]['price']) {
	                $tmp = $orders[$j - 1];
	                $orders[$j - 1] = $orders[$j];
	                $orders[$j] = $tmp;
	                $flag = true;
	            }
	        }
	        if (!$flag) {
	            break;
	        }
	    }
	    
	    if(strtoupper($type) == 'BUY')
	    	$orders = array_reverse($orders);
	    	
	    return $orders;
	}
	// Gets the lowest price sell order or highest price buy order that has a route that doesn't go through lowsec
	public function getBestPrice($orders) {
		$databaseConnection = databaseConnection::getInstance();
		// The api keys array would be your eve-online keyID and vCode
		$apiKeys = $databaseConnection->getAPIKeys();
		
		$lowestPrice = null;
		// Loop through each order to find the cheapest sell order that doesn't require you to go into lowsec
	    foreach($orders as $order) {
	        $location = explode(' ', $order['location']);
	        // Use the api.eve-inline.com to get the current location of your character
	        $currentLocation = simplexml_load_file('https://api.eveonline.com/eve/CharacterInfo.xml.aspx?keyID='.$apiKeys['eve']['keyID'].'&vCode='.$apiKeys['eve']['vCode'].'&characterID='.$apiKeys['eve']['characterID']);
	        // Pull out the last known location of your character from the XML object
	        $currentLocation = (string) $currentLocation->result->lastKnownLocation;
	        // Get the jSON object with the route data from api.eve-central.com using your characters current location and the location from the sell order
	        $routeURL = 'http://api.eve-central.com/api/route/from/'.$currentLocation.'/to/'.$location[0];
	        $route = json_decode(file_get_contents($routeURL));
	        $lowsec = false;
	        $bestPriceLocation = null;
	        // Check to see if there is a route, if the route is not set then api.eve-central.com is down
	        // Use the first value in the orders array if api.eve-central.com is down, this is the cheapest sell order because they are already sorted by price
	        if($route) {
	        	// Loop through every system in the route and check to make sure that the security status is not below .5
		        foreach ($route as $currentSystem) {
		            if($currentSystem->to->security < .5) {
		            	// If there is a system that is lowsec in the route then stop searching through this route because we only want highsec systems
		                $lowsec = true;
		                break;
		            }
		        }
		        // If lowsec is set to false for the current route then stop looping though the routes because you have found the cheapest sell order in highsec
		        if($lowsec == false)
		            break;
	        }
	        else 
		        break;
	    }
	    
	    return $order;
	}
	
	public function getLatestEntry($typeid, $type) {
		// Create a new databaseConnection Instance in order to get the database connection info
	    $databaseConnection = databaseConnection::getInstance();
	    // Get the databse connection info
	    $databaseInfo = $databaseConnection->getDatabaseInfo();
	    // Connect to the database with mysqli
	    $db = new mysqli($databaseInfo['host'], $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['db']);
	    
	    $typeid = $db->real_escape_string($typeid);
	    $type = $db->real_escape_string(strtoupper($type[0]));
	    // Get the latest entry into the database for the given typeid
	    $price_list = $db->query("
	    	SELECT
	    		price
	    	FROM
	    		market_prices
	    	WHERE
	    		type_id = '$typeid' and
	    		type = '$type'
	    	ORDER BY
	    		insert_date desc
	    	LIMIT 1
	    ");
	    
	    return $price_list->fetch_array();
	}
	
	public function insertNewPrice($bestPriceLocation, $type) {
		// Create a new databaseConnection Instance in order to get the database connection info
	    $databaseConnection = databaseConnection::getInstance();
	    // Get the databse connection info
	    $databaseInfo = $databaseConnection->getDatabaseInfo();
	    // Connect to the database with mysqli
	    $db = new mysqli($databaseInfo['host'], $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['db']);
	    
	    $typeid = $db->real_escape_string($bestPriceLocation['typeid']);
		$price = $db->real_escape_string($bestPriceLocation['price']);
        $location = $db->real_escape_string($bestPriceLocation['location']);
        $quantity = $db->real_escape_string($bestPriceLocation['quantity']);
        $reported_time = $db->real_escape_string($bestPriceLocation['reported_time']);
        $type = $db->real_escape_string(strtoupper($type[0]));

        // Insert the new price data into the market_prices table
        $query = "
            INSERT INTO
                market_prices
            (
                type_id,
                price,
                location,
                quantity,
                reported_time,
                type
            )
            VALUES (
                '$typeid',
                '$price',
                '$location',
                '$quantity',
                '$reported_time',
                '$type'
            )
        ";

        // Run the query
		$db->query($query);
	}
	public function addPageView($ip, $useragent) {
		// Create a new databaseConnection Instance in order to get the database connection info
		$databaseConnection = databaseConnection::getInstance();
		// Get the databse connection info
		$databaseInfo = $databaseConnection->getDatabaseInfo();
		// Connect to the database with mysqli
		$db = new mysqli($databaseInfo['host'], $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['db']);
		
		$locationData = $this->ipToLocation($ip);
		
		$ip = $db->real_escape_string($ip);
		$useragent = $db->real_escape_string($useragent);
		$country = $db->real_escape_string($locationData['countryCode']);
		$state = $db->real_escape_string($locationData['region']);
		$city = $db->real_escape_string($locationData['city']);
		$lat = $db->real_escape_string($locationData['latitude']);
		$lon = $db->real_escape_string($locationData['longitude']);
		
		// Insert the new user into the Users table
		$query = "
			INSERT INTO
				eve_site_hits
			(
				ip,
				useragent,
				country,
				state,
				city,
				latitude,
				longitude
			)
			VALUES (
				'$ip',
				'$useragent',
				'$country',
				'$state',
				'$city',
				'$lat',
				'$lon'
			)
		";
		// Run the query
		$db->query($query);
	}
	public function ipToLocation($ip) {
		// Create a new databaseConnection Instance in order to get the database connection info
		$databaseConnection = databaseConnection::getInstance();
		// Get the databse connection info
		$databaseInfo = $databaseConnection->getAPIKeys();

		$user = $databaseInfo['locatorhq']['user'];
		$key = $databaseInfo['locatorhq']['key'];
		
		$locationData = json_decode(file_get_contents('http://api.locatorhq.com/?key='.$key.'&user='.$user.'&format=json&ip='.$ip), true);
		
		return $locationData;
	}

}