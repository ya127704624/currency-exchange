<?php

header("Content-Type:application/json");
include('function.php');
$configs = include('config.php');

// Type 1: Top moving cryptos API
if (isset($_GET['type']) && $_GET['type']!="" && $_GET['type']==1) {
	
    $minPercentage = $configs->minPerName . '=' . $configs->minPerVal;	
    $maxPercentage = $configs->maxPerName . '=' . $configs->maxPerVal;

    // get cryptocurrencies with more than +5% change over the last 24 hours
    $apiName = $configs->apiName1;
    $param = $minPercentage;
    $result1 = callApi($apiName, $param);

    // get cryptocurrencies with less than -5% change over the last 24 hours
    $param = $maxPercentage;
    $result = array_merge($result1, callApi($apiName, $param));


    $response_desc = $result;
    response(200,$response_desc);

}
// Type 2: foreign currency API
elseif (isset($_GET['type']) && $_GET['type']!="" && $_GET['type']==2) {
    
    $symbol = $_GET['symbol'];
    $currency = $_GET['currency'];

    $apiName = $configs->apiName2;
    $param = 'amount=1&symbol=' . $symbol . '&convert=' . $currency;
    
    $result = callApi($apiName, $param);

    response(200,$result);

}
else {
	response(400,"Invalid type");
}

?>