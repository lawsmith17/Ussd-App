<?php

//Connecting to Database

$conn = new mysqli('localhost','root','','ussd_pay');

//Checking Connection

if($conn -> connect_error)
{
    die('Connection Failed: '.$conn -> connect_error);
}
