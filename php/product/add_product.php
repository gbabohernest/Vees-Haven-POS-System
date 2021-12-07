<?php

// we insert the record into the db

include("../db_connection.php");
//here we want to check before inserting the category into the db
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //prepare the sql stmt
    $stmt = $conn->prepare("INSERT INTO product (product_name,product_description,barcode,category_id,brand_id,	price_retail,price_cost,re_order_level,product_date,status)values (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssiiiss",$product_name,$product_description,$barcode,$category_id,$brand_id,	$price_retail,$price_cost,$re_order_level,$product_date,$status);


    $product_name = $_POST['productName'];
    $product_description = $_POST['productDescription'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['productBrand'];
    $price_cost = $_POST['productCostPrice'];
    $price_retail = $_POST['productRetailPrice'];
    $barcode = $_POST['productBarCode'];
    $re_order_level = $_POST['productReOrderLevel'];
    $product_date = $_POST['productDate'];
    $status = $_POST['status'];


    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0; 
    }

    $stmt->close();


}