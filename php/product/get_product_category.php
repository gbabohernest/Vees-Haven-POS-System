<?php
//fetches data from the category table and send to the product.php page
include("../db_connection.php");

$stmt = $conn->prepare("SELECT id,catname,status FROM category WHERE status ='active' ORDER by id DESC");
$stmt->bind_result($id,$catname,$status);

if($stmt->execute()){
    while($stmt->fetch()){
        $output [] = array("id"=>$id, "catname"=>$catname, "status"=>$status);
    }
    echo json_encode($output);
}

$stmt->close();

