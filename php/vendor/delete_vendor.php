<?php
//this will delete the category the user wants to delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("../db_connection.php");


    $stmt = $conn->prepare('DELETE FROM vendor WHERE vendor_id =?');
    $stmt->bind_param("s", $vendorID);

    $vendorID = $_POST['vendorID'];

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}

