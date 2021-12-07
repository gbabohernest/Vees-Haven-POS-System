<?php

include('../db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $relation_list = $_POST['data'];

    $stmt = $conn->prepare("insert into purchase(vendor_id,date,total,pay,balance,payment_type)values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiis", $vendor_id, $date, $total, $pay, $balance, $payment_type);

    $vendor_id = $_POST['vendor'];
    $date = date("Y-m-d");
    $total = $_POST['total'];
    $pay = $_POST['pay'];
    $balance = $_POST['balance'];
    $payment_type = $_POST['payment_status'];


    if ($stmt->execute()) {

        $last_id = $conn->insert_id;
    }


//this will insert the data into the purchase_item table


    for ($x = 0; $x < count($relation_list); $x++) {
        $stmt1 = $conn->prepare("insert into purchase_item(purchase_id,product_id,buy_price,qty,total)values(?, ?, ?, ?, ?)");
        $stmt1->bind_param("isiii", $last_id, $product_id, $buy_price, $qty, $total);

        $product_id = $relation_list[$x]['productCode'];
        $buy_price = $relation_list[$x]['productPrice'];
        $qty = $relation_list[$x]['productQty'];
        $total = $relation_list[$x]['productTotalCost'];


        if ($stmt1->execute()) {
//            echo 1;
        } else {
//            echo $conn->error;
        }

        $stmt1->close();
    }

echo json_encode(array ("last_id" =>$last_id) );
$stmt->close();
}