<?php

//this will fetch the data (category) the user wants to edit base on the id.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../db_connection.php");

    $stmt = $conn->prepare("SELECT id,brandname,status FROM brand WHERE id=?");
    $brand = $_POST['brandID'];
    $stmt->bind_param("s", $brand);

    $stmt->bind_result($id,$brandname,$status);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output = array("id" => $id, "brandname" => $brandname, "status" => $status);
        }
        echo json_encode($output);
    }

    $stmt->close();

}