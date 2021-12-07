<?php

//this will update the edited vendor the user wants to edit

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../db_connection.php');

    $stmt = $conn->prepare('UPDATE vendor SET vendor_name=?,contact_no=?,email=?,address=?,status=? where vendor_id=?');

    $stmt->bind_param("sissss", $vendor_name,$contact_no,$email,$address,$status,$vendorID);

    $vendorID = $_POST['vendorID'];

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



