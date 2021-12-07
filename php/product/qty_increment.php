<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../db_connection.php');
    $stmt = $conn->prepare("update product set qty=qty+? where barcode=?");

    $stmt->bind_param("is", $qty,$product_id);

    $product_id = $_POST['productCode'];
    $qty = $_POST['productQty'];




    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}



