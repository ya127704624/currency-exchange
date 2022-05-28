<?php

// Prepare API response
function response($response_code, $response_desc){
	
	$response['data'] = $response_desc;
	$response['response_code'] = $response_code;

	$json_response = json_encode($response);
	echo $json_response;
}

// Call CoinMarketCap API
function callAPI($apiName, $param){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pro-api.coinmarketcap.com' . $apiName . '?' . $param,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'X-CMC_PRO_API_KEY: d384b03e-e440-43ac-82ec-a60fe10e51a2'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($response,true);
	
    if ($data['status']['error_code'] > 0)
    {
        return $data['status']['error_message'];
    }
    else
    {
        return $data['data'];
    }
}

?>