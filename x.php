<?php

$obj = new stdClass();
$item = $username;
$curl = curl_init();
    $obj->sqli = $item;
    $resBody = json_encode($obj);
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://172.17.57.4:8008/main', 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$resBody,
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    error_reporting(E_ERROR | E_PARSE); // For removing the error.
?>
