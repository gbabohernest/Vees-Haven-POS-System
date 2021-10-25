<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('../db_connection.php');

    $stmt = $conn->prepare("update category set catname=?,status=? where id=?");
    $stmt->bind_param("sss", $catname,$status,$categoryId);

    $categoryId = $_POST['categoryId'];
    $catname = $_POST['catname'];
    $status =$_POST['status'];

    if ($stmt->execute()){
        echo 1;
    }else {
        echo 0;
    }

    $stmt->close();
}
