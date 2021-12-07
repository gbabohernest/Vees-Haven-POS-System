<?php

// we insert the record into the db


include("../db_connection.php");
//here we want to check before inserting the category into the db
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //prepare the sql stmt
    $stmt = $conn->prepare("INSERT INTO brand (brandname,status)values (?,?);");
    $stmt->bind_param("ss",$brandname,$status);


    $brandname = $_POST['brandname'];
    $status = $_POST['status'];

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();


}