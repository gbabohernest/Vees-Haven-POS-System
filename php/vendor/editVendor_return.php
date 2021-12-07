<?php


//this will fetch the data (vendor) the user wants to edit base on the id.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../db_connection.php");

    $stmt = $conn->prepare('SELECT vendor_id,vendor_name,contact_no,email,address,status FROM vendor WHERE vendor_id=?');

    $vendor = $_POST['vendorID'];

    $stmt->bind_param("s", $vendor);

    $stmt->bind_result($vendor_id,$vendor_name,$contact_no,$email,$address,$status);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output = array("vendor_id" => $vendor_id, "vendor_name" => $vendor_name, "contact_no" =>$contact_no,
                           "email" => $email, "address" =>$address, "status" => $status);
        }
        echo json_encode($output);
    }

    $stmt->close();

}