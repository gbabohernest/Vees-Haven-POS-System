<?php
//fetches data from the category table in db
include("../db_connection.php");

$stmt  = $conn->prepare("select id,catname,status from category order by id DESC ;");
$stmt->bind_result($id, $catname, $status);

if($stmt->execute()){
    while($stmt->fetch()){
        $output [] = array("id"=>$id, "catname"=>$catname, "status"=>$status);
    }
    echo json_encode($output);
}

$stmt->close();