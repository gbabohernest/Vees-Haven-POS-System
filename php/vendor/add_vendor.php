<?php

// we insert the record into the db


include("../db_connection.php");
//here we want to check before inserting the category into the db
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //prepare the sql stmt
    $stmt = $conn->prepare("INSERT INTO vendor(vendor_name,contact_no,email,address,status) values(?,?,?,?,?)");

    $stmt->bind_param("sisss", $vendor_name,$contact_no,$email,$address,$status);

    $vendor_name = $_POST['vendor_name'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email']; 
    $address = $_POST['address']; 
    $status = $_POST['status']; 


    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();


}