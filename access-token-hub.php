<?php

$grantType = 'authorization_code'; 
$code = ''; 
$redirectUri = ''; 
$clientId = ''; 
$clientSecret = ''; 


$hubspotTokenEndpoint = 'https://api.hubapi.com/oauth/v1/token';


$postFields = http_build_query([
    'grant_type' => $grantType,
    'code' => $code,
    'redirect_uri' => $redirectUri,
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
]);

// Initialize cURL
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $hubspotTokenEndpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postFields,
    CURLOPT_HTTPHEADER => [
        'content-type: application/x-www-form-urlencoded',
    ],
]);

$response = curl_exec($curl);


if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    exit;
}


curl_close($curl);


$responseData = json_decode($response, true);
if ($responseData) {
    echo '<pre>';
    print_r($responseData);
    echo '</pre>';
} else {
    echo 'Invalid response received.';
}
