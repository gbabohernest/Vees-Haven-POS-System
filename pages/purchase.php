<?php include("header.php") ?>

<div class="container-fluid">
    <div class="row">
        <!-- add purchase  form-->
        <div class="col-sm-8">
            <div class="card mt-1 ">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Purchase</h4>
                    </div>
                </div>

                <div class="card-body ">
                    <form class="form-row form-vendor">
                        <div class="row">
                            <div class="form-group col-sm-2 float-end">
                                <label for="vendor_purchase" class="fw-bold">Vendor</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <select class="form-control mb-2" id="vendor_purchase" name="vendor_purchase">
                                    <option value="">Please Select</option>
                                </select>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>  <!--   purchase vendor card end  -->

                <!--  add products  card-->
                <div class="card">
                    <div class="card-body">
                        <form id="form-product">
                            <p class="fw-bold">Add Products</p>
                            <table class="table table-bordered table-striped">
                                <tr class="d-sm-table-row">
                                    <th class="col-sm-2">Product Code</th>
                                    <th class="col-sm-3">Product Name</th>
                                    <th class="col-sm-2">Unit Price</th>
                                    <th class="col-sm-2">QTY</th>
                                    <th class="col-sm-2">Amount</th>
                                    <th class="col-sm-2">Option</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="productCode" class="form-control col-sm-2"
                                               name="productCode" placeholder="product code"
                                               required>
                                    </td>
                                    <td>
                                        <input type="text" id="productName" class="form-control col-sm-3"
                                               name="productName" disabled
                                               required>
                                    </td>
                                    <td>
                                        <input type="text" id="productPrice" class="form-control col-sm-2"
                                               name="productPrice"
                                               disabled>
                                    </td>
                                    <td>
                                        <input type="number" id="productQty" class="form-control col-sm-2"
                                               name="productQty" placeholder="QTY"
                                               min="1" value="1" required>
                                    </td>
                                    <td>
                                        <input type="text" id="productTotalCost" class="form-control col-sm-2"
                                               name="productTotalCost" disabled>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" type="button" onclick="addProduct()">
                                            Add
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </div>
                </div> <!-- Add products  card table end-->

                <!--  display products card table-->
                <div class="card">
                    <div class="card-body">

                        <p class="fw-bold">Products</p>
                        <table class="table table-bordered table-striped" id="productList">
                            <thead>
                            <tr class="d-sm-table-row">
                                <th class="col-sm-2">Remove</th>
                                <th class="col-sm-2">Product Code</th>
                                <th class="col-sm-3">Product Name</th>
                                <th class="col-sm-2">Unit Price</th>
                                <th class="col-sm-2">QTY</th>
                                <th class="col-sm-2">Price</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--  display products card table end-->
            </div> <!-- end of card-->
        </div><!-- add purchase  form end-->

        <div class="col-sm-4">
            <div class="card mt-1">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Invoice</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" id="total" class="form-control" name="total" placeholder="total" disabled>
                    </div>
                    <br>
                    <div class="form-group ">
                        <label for="pay">Pay</label>
                        <input type="text" id="pay" class="form-control" name="pay"
                               placeholder="pay"
                               required>
                    </div>
                    <br>
                    <div class="form-group ">
                        <label for="balance">Balance</label>
                        <input type="text" id="balance" class="form-control" name="balance"
                               placeholder="balance"
                               required>
                    </div>
                    <br>
                    <div class="form-control">
                        <label for="payment_status">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="">Please Select</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                        </select>
                    </div>
                    <div class="mt-3 float-end">
                        <button type="button" class="btn btn-outline-danger float-end m-2" id="reset">Reset</button>
                        <button type="button" class="btn btn-outline-primary float-end m-2" id="save"
                                onclick="addInvoice()">Add Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--row end-->

</div> <!--end of purchase -->

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


<!--jquery script-->
<script>
    let isNew = true;
    getProductCode();
    getVendor();

    function getProductCode() {
        $("#productCode").keyup(function (e) {

            $.ajax({
                type: "POST",
                url: '../php/product/get_product.php',
                dataType: "JSON",
                data: {productCode: $("#productCode").val()},

                success: function (data) {
                    $("#productName").val(data[0].product_name);
                    $("#productPrice").val(data[0].price_retail);
                    $("#productQty").focus();

                },

                error: function () {

                }
            })
        });
    } //getProudctCode function end.

    $(function () {
        $("#productPrice, #productQty").on("keydown keyup click", calcProduct);

        function calcProduct() {
            let the_product = (Number($("#productPrice").val()) * Number($("#productQty").val()));

            $('#productTotalCost').val(the_product);
        }
    });//calcute product amount fun end


    function getVendor() {
        $.ajax({
            type: "GET",
            url: '../php/vendor/get_vendor.php',
            dataType: "JSON",

            success: function (data) {
                for (let counter = 0; counter < data.length; counter++) {
                    $('#vendor_purchase').append($("<option/>", {
                        value: data[counter].vendor_id,
                        text: data[counter].vendor_name,
                    }));
                }
            },

            error: function () {

            }
        })
    } //display vendors in the table


    function addProduct() {
        let product = {
            productCode: $("#productCode").val(),
            productName: $("#productName").val(),
            productPrice: $("#productPrice").val(),
            productQty: $("#productQty").val(),
            productTotalCost: $("#productTotalCost").val()
        };
        addRow(product);
        $("#form-product")[0].reset(); //this clear the form
    }

    let totalAmount = 0;
    let ugx = 'UGX';

    function addRow(product) {

        if ($('#productCode').val().length === 0) {
            $.alert({
                title: 'Error',
                content: "Please Enter the Product Code",
                type: 'red',
                autoClose: 'ok|2000'
            });
        } else if (!$('#vendor_purchase').val()) {
            $.alert({
                title: 'Error',
                content: "Please Select the Vendor",
                type: 'red',
                autoClose: 'ok|2000'
            });

        } else {
            $.ajax({
                type: "POST",
                url: '../php/product/qty_increment.php',
                dataType: "JSON",
                data    : {productQty: $("#productQty").val(),  productCode: $("#productCode").val() },

                success: function (data) {

                },

                error: function () {

                }
            })


            let $tableBody = $("#productList tbody");
            let $tableRow = $(
                "<tr>" +
                "<td><button type='button' name='record' class='btn btn-danger btn-xs' onclick='deleteRow(this)'>Delete </td>" +
                "<td>" + product.productCode + "</td>" +
                "<td>" + product.productName + "</td>" +
                "<td>" + product.productPrice + "</td>" +
                "<td>" + product.productQty + "</td>" +
                "<td>" + product.productTotalCost + "</td>" +
                "</tr>"
            );
            $tableRow.data("productCode", product.productCode);
            $tableRow.data("productName", product.productName);
            $tableRow.data("productPrice", product.productPrice);
            $tableRow.data("productQty", product.productQty);
            $tableRow.data("productTotalCost", product.productTotalCost);


            $tableBody.append($tableRow);

            //    calcluate the total amount
            totalAmount += Number(product.productTotalCost);
            $('#total').val(totalAmount);
        }
    } //add row and calculate total amount function end


    let product_total_cost;

    function deleteRow(e) {
        product_total_cost = parseInt($(e).parent().parent().find('td:last').text(), 10);
        totalAmount -= product_total_cost;

        $('#total').val(totalAmount);

        $(e).parent().parent().remove();
    }

    //delete product and reduce the total price


    $(function () {
        $("#pay, #total").on("keydown keyup ", calcBalance);

        function calcBalance() {
            let difference = (Number($("#total").val()) - Number($("#pay").val()));

            $('#balance').val(difference + " " + ugx);
        }
    });

    //add Invoice into the database
    function addInvoice() {
        let table_data = [];

        $('#productList tbody tr').each(function (row, tr){

            let sub;
            sub = {
                'productCode': $(tr).find('td:eq(1)').text(),
                'productName': $(tr).find('td:eq(2)').text(),
                'productPrice': $(tr).find('td:eq(3)').text(),
                'productQty': $(tr).find('td:eq(4)').text(),
                'productTotalCost': $(tr).find('td:eq(5)').text()
            }
            table_data.push(sub);
        });

        $.ajax({
            type: 'POST',
            url: '../php/product/add_purchase.php',
            dataType: 'JSON',
            data: {
                vendor: $('#vendor_purchase').val(), total: $('#total').val(), pay: $('#pay').val(),
                balance: $('#balance').val(), payment_status: $('#payment_status').val(), data: table_data
            },
            //NEED TO WORK ON THIS AREA
            success : function(data) {
                let message;
                if(isNew)
                {
                    message = "<h6 class='fw-bold text-center'>Purchase Completed</h6>"
                }

                $.alert({
                    title   : '<h4 class="fw-bold">Success</h4>' ,
                    content : message,
                    type    : 'green',
                    autoClose: 'ok|2000'
                });

                last_id = data.last_id
                window.location = "print.php?last_id=" + last_id;

            },

            // error: function (xhr, status, error) {
            //     alert(xhr);
            //     console.log(xhr.responseText);
            //
            //     $.alert({
            //         title: 'Fail!',
            //         //content: xhr.responseJSON.errors.product_cord + '<br>' + xhr.responseJSON.msg,
            //         type: 'red',
            //         autoClose: 'ok|2000'
            //     });
            //     $('#save').prop('disabled', false);
            //     $('#save').html('');
            //     $('#save').append('Save');
            // }
        });
    }   //addinvoice function end


</script>
</body>
</html>
