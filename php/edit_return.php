<?php
//this will fetch the data (category) the user wants to edit base on the id.

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ("../db_connection.php");

    $stmt = $conn->prepare('SELECT id,catname,status FROM category WHERE id=?');
    $category = $_POST['categoryId'];
    $stmt->bind_param("s", $category);

    $stmt->bind_result($id,$catname,$status);

    if($stmt->execute()){
        while($stmt->fetch()){
            $output = array("id"=>$id, "catname"=>$catname, "status"=>$status);
        }
        echo json_encode($output);
    }
 $stmt->close();
}