<?php
$db_host = "localhost";
$db_user = "root";
$db_pw = "";
$db_name = "vh-pos";


$conn = new mysqli($db_host, $db_user, $db_pw, $db_name);

if ($conn->connect_error)
{
    die("Connection Failed :" .$conn->connect_error);
}