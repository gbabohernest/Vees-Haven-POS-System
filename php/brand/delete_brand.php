<?php

//this will delete the category the user wants to delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("../db_connection.php");


    $stmt = $conn->prepare('DELETE FROM brand WHERE id=?');
    $stmt->bind_param("s", $brandID);

    $brandID = $_POST['brandID'];

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}
