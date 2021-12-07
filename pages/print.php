<?php
//include("header.php")
include("../php/db_connection.php");
$ugx = 'UGX';


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $last_id = $_GET['last_id'];
    $sql = "select i.purchase_id,i.product_id,i.buy_price,i.qty,i.total,p.date,p.total,p.pay,p.balance,pr.product_name  from purchase p, purchase_item i, product pr where p.id = i.purchase_id	and i.purchase_id and pr.barcode = i.product_id and i.purchase_id = $last_id";

    $orderResult = $conn->query($sql);
    $orderData = $orderResult->fetch_array();

    $purchase_id = $orderData[0];
    $product_id = $orderData[1];
    $buy_price = $orderData[2];
    $qty = $orderData[3];
    $total = $orderData[4];
    $date = $orderData[5];
    $subtotal = $orderData[6];
    $pay = $orderData[7];
    $balance = $orderData[8];
    $product_name = $orderData[9];
}

?>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap   -->
    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href=components/bootstrap/dist/css/bootstrap.css>
    <link rel="stylesheet" href="components/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="components/DataTables/datatables.min.css"/>

    <title></title>

    <style>
        @media print {
            .button {
                display: none;
            }
        }

        @media print {
            @page  {
                margin-top: 0;
                margin-bottom: 0;
            }
            body{
                padding-top: 72px;
                padding-bottom: 72px;
            }
        }
    </style>
</head>
<body>
<!---->

<div class="container-fluid " style="background: #f9f9f9; height: 100%;">
    <div class="row">
        <div class="col-xs-12" style="border:1px solid #a1a1a1; width: 88mm; background: #FFFFFF; padding: 10px; margin: 0 auto; text-align: center;">
            <!-- 88m-->
            <!--                <div class="">-->
            <div class="card mt-1">
                <div class="card-header">
                    <h4>Purchase Invoice</h4>
                </div>
                <div class="card-body">
                    <div class="card-text float-start">
                        Date <b><?php echo $date; ?></b>
                    </div>
                    <br>
                    <div class="card-text float-end ">
                        Invoice No: <b><?php echo $last_id; ?></b>
                    </div>
                    <br> <br>

                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>

                        </thead>
                        <?php
                            $x = 1;
                            $orderResult = $conn->query($sql);
                            while($row = $orderResult->fetch_array())
                            {

                        ?>
                        <tbody>
                        <tr>
                            <th scope="row"><?php echo $x ?> </th>
                            <td><?php echo $row[9] ?></td>
                            <td><?php echo $row[3] ?></td>
                            <td><?php echo $row[2].$ugx ?></td>
                            <td><?php echo $row[4] .$ugx  ?></td>
                        </tr>
                        <?php  $x++; }  ?>

                        </tbody>

                    </table>

                    <div class="card-text float-end">
                        Sub-total   <b><?php echo $subtotal .$ugx; ?></b>
                    </div>
                    <br>
                    <div class="card-text float-end">
                        Pay  <b><?php echo $pay .$ugx; ?></b>
                    </div>
                    <br>
                    <div class="card-text float-end">
                        Balance   <b><?php echo $balance .$ugx; ?></b>
                    </div>
                </div>

            </div>

            <br>


        </div>


        <!--                    </div>-->
    </div>
</div>




<!--scripts links-->
<script src="components/jquery/jquery-3.6.0.js"></script>
<script src="components/jquery/jquery-3.6.0.min.js"></script>
<script src="components/jquery.validate.min.js"></script>
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>
<!--<script src="components/bootstrap/dist/js/bootstrap.js"></script>-->
<!--<script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>-->
<script src="components/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
<!-- data table -->
<!--<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>-->
<script src="components/DataTables/datatables.min.js"></script>


<!-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> -->

<!--end of scripts links -->

<script>
 myFunction();
 function myFunction(){
     window.print();
 }

 window.onafterprint = function(e) {
     closePrintView();
 };


 function closePrintView(){
     window.location.href = 'sales.php';
 }
</script>


</body>
</html>
