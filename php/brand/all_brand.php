<?php

//fetches data from the brand table in db
include("../db_connection.php");



$stmt = $conn->prepare("select id,brandname,status from brand order by id DESC");
$stmt->bind_result($id,$brandname,$status);

if ($stmt->execute()) {
    while ($stmt->fetch()) {
        $output [] = array("id" => $id, "brandname" => $brandname, "status" => $status);
    }
    echo json_encode($output);
}

$stmt->close();