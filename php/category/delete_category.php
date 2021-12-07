<?php

//this will delete the category the user wants to delete
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("../db_connection.php");


    $stmt = $conn->prepare('DELETE FROM category WHERE id=?');
    $stmt->bind_param("s", $categoryID);

    $categoryID = $_POST['categoryID'];

    if($stmt->execute()){
        echo 1;
    }
    else {
        echo 0;
    }

    $stmt->close();

}
