<?php


$filePath = 'webhook_log.txt';


$fileContents = file_get_contents($filePath);

if ($fileContents === false) {
    echo "Error reading file.";
    exit;
}


$data = json_decode($fileContents, true);


if (json_last_error() === JSON_ERROR_NONE) {
    // Set variables from the array
    $firstName = $data['First Name'] ?? null;
    $lastName = $data['Last Name'] ?? null;
    $email = $data['Email'] ?? null;
    $phoneNumber = $data['Phone Number'] ?? null;
    $zohoId = $data['Zoho_Id'] ?? null;

} else {
    echo "Error decoding JSON: " . json_last_error_msg();
}





include "access-token-hub-refresh.php";
$accessToken = $responseData['access_token'];


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode(array(
        'properties' => array(
            'email' => $email,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'phone' => $phoneNumber,
            'zoho_id' => $zohoId,
        ),
    )),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $accessToken,
    ),
));


$response = curl_exec($curl);


if (curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
} else {
    echo $response;
}


curl_close($curl);
