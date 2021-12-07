<?php

//this will update the edited brand the user wants to edit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include('../db_connection.php');

    $stmt = $conn->prepare("UPDATE brand SET brandname=?,status=? WHERE id=?");
    $stmt->bind_param("sss", $brandname, $status, $brandID);

    $brandID = $_POST['brandID'];

    $brandname = $_POST['brandname'];
    $status = $_POST['status'];

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();
}
