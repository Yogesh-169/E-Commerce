<?php
session_start();
$ch = curl_init();  

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_2297e8dcf13a88a5e80e85276a6",
                  "X-Auth-Token:test_f504329b951d05f202113dc2c29"));
$payload = Array(
    'purpose' => "shopping bill",
    'amount' => $_REQUEST['total'],
    'phone' => $_REQUEST['phone'],
    'buyer_name' => $_REQUEST['name'],
    'redirect_url' => 'http://localhost/producttry/User/redirect.php',
    'send_email' => true,
    // 'webhook' => 'http://test.example.com/webhook/',
    'send_sms' => true, 
    'email' => $_REQUEST['email'],
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$response = json_decode($response);
$_SESSION['TID']=$response->payment_request->id;
header('location:'.$response->payment_request->longurl);
die();
// echo $response;
// echo "<pre>";
// print_r($response);
// echo "</pre>";
?>  