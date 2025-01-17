<?php

$data = file_get_contents('php://input');

$decodedData = json_decode($data, true);

$headers = getallheaders();

$logFile = 'webhook_log.txt';

if (!file_exists($logFile)) {
    file_put_contents($logFile, $data);
}

file_put_contents($logFile, $data);


header('Content-Type: application/json');

if ($decodedData) {
    echo json_encode(['status' => 'success', 'message' => 'Data received successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
//  calling file that  craete contact in hubspot;

include  'create-contact-in-hub.php';
