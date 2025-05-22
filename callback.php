<?php
header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');

$logFile = "stkCallbackResponse.json";

$data = '{}';

file_put_contents($logFile,$data);

$log = fopen($logFile,'a');

fwrite($log,$stkCallbackResponse);
fclose($log);

//decoding json
$callbackContent = json_decode($stkCallbackResponse);

$ResultCode = $callbackContent->Body->stkCallback->ResultCode;
$CheckoutRequestID $callbackContent->Body->stkCallback->checkoutRequestID;
$Amount $callbackContent->Body->stkcallback->CallbackMetadata->Item[0]->Value;
$MpesaReceiptNumber $callbackContent->Body->stkcallback->CallbackMetadata->Item[1]->Value;
$PhoneNumber= $callbackContent->Body->stkcallback->CallbackMetadata->Item[4]->Value;
$ExternalReference = $callbackContent->Body->stkcallback->ExternalReference;

if ($Resultcode ==0)

{


    //user has paid successfully
    include 'conn.php';

//linsert data into payments table
$Sql ="INSERT INTO ussd (CheckoutRequestID, Amount,MpesaReceiptNumber,PhoneNumber) VALUES ('$CheckoutRequestID','$Amount','$MpesaReceiptNumber','$PhoneNumber')";

$result = $conn->query($sql);

$conn = null;

}

