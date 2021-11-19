<?php
//this will update the edited data the user wants to edit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include ('../db_connection.php');

    $stmt = $conn->prepare("UPDATE category SET catname=?,status=? WHERE id=?");
    $stmt->bind_param("sss", $catname,$status,$categoryID);

    $categoryID = $_POST['categoryID'];

    $catname = $_POST['catname'];
    $status = $_POST['status'];

    if($stmt->execute()){
        echo 1;
    }else{
        echo 0;
    }

    $stmt->close();
}
