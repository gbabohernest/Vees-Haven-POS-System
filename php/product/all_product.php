<?php

//fetches data from the product table in db
include("../db_connection.php");
$ugx = 'UGX';


$stmt = $conn->prepare("select product_id ,product_name,product_description,barcode,category_id,brand_id,price_retail,price_cost,re_order_level,Qty,product_date,status from product order by product_id DESC");
$stmt->bind_result($product_id, $product_name, $product_description, $barcode, $category_id, $brand_id, $price_retail, $price_cost, $re_order_level, $Qty, $product_date, $status);

if ($stmt->execute()) {
    while ($stmt->fetch()) {
        $output [] = array("product_id" => $product_id, "product_name" => $product_name, "product_description" => $product_description,
            "barcode" => $barcode, "category_id" => $category_id, "brand_id" => $brand_id, "price_retail" => $price_retail,
            "price_cost" => $price_cost, "re_order_level" => $re_order_level, "Qty" => $Qty, "product_date" => $product_date,
            "status" => $status);
    }
    echo json_encode($output);
}

$stmt->close();