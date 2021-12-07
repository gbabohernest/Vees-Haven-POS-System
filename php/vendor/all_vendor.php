<?php

//fetches data from the brand table in db
include("../db_connection.php");


$stmt = $conn->prepare("select vendor_id,vendor_name,contact_no,email,address,status from vendor order by vendor_id DESC");
$stmt->bind_result($vendor_id,$vendor_name,$contact_no,$email,$address,$status );

if ($stmt->execute()) {
    while ($stmt->fetch()) {
        $output [] = array("vendor_id" => $vendor_id, "vendor_name" => $vendor_name, "contact_no" => $contact_no,
                            "email" => $email,"address" => $address,"status" => $status);
    }
    echo json_encode($output);
}

$stmt->close();