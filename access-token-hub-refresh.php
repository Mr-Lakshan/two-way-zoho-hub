<?php


$clientId = '<add client-id here >';        // add client-id here 
$clientSecret = '<add client-secret here>'; // add client-secret here 
$refreshToken = '<add refresh token here>'; // add refresh token here


$url = 'https://api.hubapi.com/oauth/v1/token';


$data1 = [
    'grant_type' => 'refresh_token',
    'refresh_token' => $refreshToken,
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
];


$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data1));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
]);


$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    
    $responseData = json_decode($response, true);
    // print_r($responseData);
}


curl_close($ch);
?>
