<?php include("header.php") ?>
<!--
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form id="form-product">
                <div class="product_center">
                    <h3 class="text-center text-uppercase">Product</h3>
                    <br>
                    <div class="row">

                        <div class="col-sm-3">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" class="form-control" name="productName"
                                   placeholder="product name"
                                   required>
                        </div>

                        <div class="col-sm-3">
                            <label for="productDescription">Product Description</label>
                            <input type="text" id="productDescription" class="form-control" name="productDescription"
                                   placeholder="product description"
                                   required>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" >
                                    <option value="">Please Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="productBrand">Brand</label>
                                <select class="form-control" id="productBrand" name="productBrand">
                                    <option value="">Please Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="productCostPrice">Cost Price</label>
                                <input type="text" id="productCostPrice" class="form-control" name="productCostPrice"
                                       placeholder="cost price"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="productRetailPrice">Retail Price</label>
                                <input type="text" id="productRetailPrice" class="form-control"
                                       name="productRetailPrice" placeholder="retail price"
                                       required>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="productBarCode">Barcode</label>
                                <input type="text" id="productBarCode" class="form-control" name="productBarCode"
                                       placeholder="barcode"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="productReOrderLevel">Re-Order Level</label>
                                <input type="text" id="productReOrderLevel" class="form-control"
                                       name="productReOrderLevel" placeholder="re-order level"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group" align="left">
                                <label for="productDate">Product Date</label>
                                <input type="date" id="productDate" class="form-control" name="productDate"
                                       placeholder="product date"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Please Select</option>
                                    <option value="active">Active</option>
                                    <option value="de-active">De-Active</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    //row end
                    <div  align="right">
                        <button type="button" class="btn btn-primary" id="save" onclick="addProduct()">Add
                        </button>
                        <button type="button" class="btn btn-danger"  id="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
//fluid container end
//end of product form
<br>
 -->

<!--
   <div class="col-sm-12">

            <div class="panel-body">
                <table class="table table-responsive table-bordered" cellspacing="0" width="100%"
                       id="table-product">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
 -->


<!--new product -->

<div class="container-fluid">
    <div class="row">
        <!-- add Product -->
        <div class="col-sm-12">
            <div class="card mt-1 ">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Add Product</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <form id="form-product" >
                        <div class="form-row">
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="productName">Product Name</label>
                                    <input type="text" id="productName" class="form-control" name="productName"
                                           placeholder="product name"
                                           required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="productDescription">Product Description</label>
                                    <input type="text" id="productDescription" class="form-control" name="productDescription"
                                           placeholder="product description"
                                           required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" >
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="productBrand">Brand</label>
                                    <select class="form-control" id="productBrand" name="productBrand" >
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                                 <div class="form-group col-sm-2">
                                    <label for="productCostPrice">Cost Price</label>
                                    <input type="text" id="productCostPrice" class="form-control" name="productCostPrice"
                                           placeholder="cost price"
                                           required>
                                </div>
                                 <div class="form-group col-sm-2">
                                    <label for="productRetailPrice">Retail Price</label>
                                    <input type="text" id="productRetailPrice" class="form-control" name="productRetailPrice"
                                           placeholder="Retail price"
                                           required>
                                </div>
                            </div> <!--first row end-->
                            <br>

                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="productBarCode">Barcode</label>
                                    <input type="text" id="productBarCode" class="form-control"
                                           name="productBarCode" placeholder="barcode"
                                           required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="productReOrderLevel">Re-Order Level</label>
                                    <input type="text" id="productReOrderLevel" class="form-control"
                                           name="productReOrderLevel" placeholder="re-Order-Level"
                                           required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="productDate">Product Date</label>
                                    <input type="date" id="productDate" class="form-control"
                                           name="productDate" placeholder="product date"
                                           required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Please Select</option>
                                        <option value="active">Active</option>
                                        <option value="de-active">De-Active</option>
                                    </select>
                                </div>
                            </div> <!--second row end-->
                        </div>

                        <div class="mt-3 float-end">
                            <button type="button" class="btn btn-outline-primary" id="save" onclick="addProduct()">Add
                            </button>
                            <button type="button" class="btn btn-outline-danger"   id="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--add product table end -->

<!--displaying product table-->
<  <div class="col-sm-12">
    <div class="card mt-1">
        <div class="card-header">
            <div class="card-title">
                <h4 class="text-center">All Products</h4>
            </div>
        </div>
        
         <div class="card-body">
                <table class="table table-responsive table-bordered table-striped" style="width:100%"
                       id="table-product">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
        </div>
    </div>
</div>
<!--displaying product table end-->


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



<!--jquery script-->
<script>
    getCategory(); 
    getBrand();
    displayProductDataInTable();
    

// load category into product page
    function getCategory(){
        $.ajax({
            type    : 'GET',
            url     : '../php/product/get_product_category.php', 
            dataType: 'JSON',

            success :   function(data) {
                for (let counter = 0;  counter< data.length; counter++){
                    $('#category').append($("<option/>", {
                        value: data[counter].id,
                        text: data[counter].catname,
                    }));
                }
            },

            error: function (xhr, status, error) {
                    alert(xhr);
                    console.log(xhr.responseText);

                    $.alert({
                        title: 'Fail!',
                        //content: xhr.responseJSON.errors.product_cord + '<br>' + xhr.responseJSON.msg,
                        type: 'red',
                        autoClose: 'ok|2000'
                    });
                    $('#save').prop('disabled', false);
                    $('#save').html('');
                    $('#save').append('Save');
                }            
        });
    } //get category fun end

    //load brand into product page
     function getBrand(){
        $.ajax({
            type    : 'GET',
            url     : '../php/product/get_product_brand.php', 
            dataType: 'JSON',

            success :   function(data) {
                for (let counter = 0;  counter< data.length; counter++){
                    $('#productBrand').append($("<option/>", {
                        value: data[counter].id,
                        text: data[counter].brandname,
                    }));
                }
            },

            error: function (xhr, status, error) {
                    alert(xhr);
                    console.log(xhr.responseText);

                    $.alert({
                        title: 'Fail!',
                        //content: xhr.responseJSON.errors.product_cord + '<br>' + xhr.responseJSON.msg,
                        type: 'red',
                        autoClose: 'ok|2000'
                    });
                    $('#save').prop('disabled', false);
                    $('#save').html('');
                    $('#save').append('Save');
                }            
        });
    } //getBrand fun end

 
    let isNew = true;
    let brandID = null;


    function addProduct() {
        if ($("#form-product").valid()) {
            let _url = "";
            let _data = "";
            let _method;

            if (isNew === true) {
                _url = '../php/product/add_product.php';
                _data = $("#form-product").serialize();
                _method = "POST";

            }
            // else {
            //     //update the edited category
            //     _url = '../php/update_brand.php';
            //     _data = $("#form-brand").serialize() + "& brandID=" + brandID;
            //     _method = "POST";
            // }

            $.ajax({
                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                //display success message
                success: function (data) {
                    displayProductDataInTable();
                    let msg;

                    if (isNew) {
                        msg = "<h6 class='text-center fw-bold'> Product Created</h6>"
                    } 
                   /*  else {
                        msg =  "<h6 class='text-center fw-bold'> Brand Updated</h6>"
                    } */

                    $.alert({
                        title: '<h4 class="fw-bold ">Success!</h4>',
                        content: msg,
                        type: 'green',
                        boxWidth: '400px',
                        theme: 'light',
                        useBootstrap: false,
                        autoClose: 'ok|2000'
                    });
                    // isNew = true;
                },

                //display error message
                error: function (xhr, status, error) {
                    alert(xhr);
                    console.log(xhr.responseText);

                    $.alert({
                        title: 'Fail!',
                        //content: xhr.responseJSON.errors.product_cord + '<br>' + xhr.responseJSON.msg,
                        type: 'red',
                        autoClose: 'ok|2000'
                    });
                    $('#save').prop('disabled', false);
                    $('#save').html('');
                    $('#save').append('Save');
                }
            });
        }
    } //    end of add product fun

    function displayProductDataInTable(){
        // let productTable = $('#table-product').DataTable()
        // productTable.clear().draw();

        $.ajax({
            url:    "../php/product/all_product.php",
            type:   "GET", 
            dataType: "JSON", 

            success: function (data) {
                $('#table-product').dataTable({
                    "bDestroy": true,
                    "aaData": data,
                    "scrollX": true,
                    "scrollY": true,

                    "aoColumns": [
                        {"sTitle": "Product Name", "mData": "product_name"},
                        {"sTitle": "Product Description", "mData": "product_description"},
                        {"sTitle": "Category", "mData": "category_id"},
                        {"sTitle": "Brand", "mData": "brand_id"},
                        {"sTitle": "Cost Price", "mData": "price_cost"},
                        {"sTitle": "Retail Price", "mData": "price_retail"},
                        {"sTitle": "Barcode", "mData": "barcode"},
                        {"sTitle": "Re-Order Level", "mData": "re_order_level"},
                        {"sTitle": "Qty", "mData": "Qty"},
                        {"sTitle": "Product Date", "mData": "product_date"},

                        {
                            "sTitle": "Status", "mData": "status", "render": function (mData, type, row, meta) {
                                if (mData === "active") {
                                    return '<span class="label label-info">Active</span>';
                                } else if (mData === "de-active") {
                                    return '<span class="label label-warning">De-active</span>';
                                }
                            }
                        },

                         {
                            "sTitle": "Edit",
                            "mData": "product_id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-primary" onclick="editVendorDetials(' + mData + ')">Edit</button>';
                            }
                        },

                        {
                            "sTitle": "Delete",
                            "mData": "product_id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-danger" onclick="deleteVendor(' + mData + ')">Delete</button>';
                            }
                        }
                    ]
                }).clear().draw();
            },

            error: function (xhr, status, error) {
                alert(xhr);
                console.log(xhr.responseText);

                $.alert({
                    title: 'Fail!',
                    //            content: xhr.responseJSON.errors.product_code + '<br>' + xhr.responseJSON.msg,
                    type: 'red',
                    autoClose: 'ok|2000'

                });
                $('#save').prop('disabled', false);
                $('#save').html('');
                $('#save').append('Save');
            }
        });
    }

    
    /*
    function editVendorDetials(id) {
        $.ajax({
            type: "POST",
            url: "../php/editBrand_return.php",
            dataType: "JSON",
            data: {brandID: id},

            success: function (data) {
                $("html, body").animate({scrollTop: 0}, "slow");
                isNew = false
                // console.log(data);

                brandID = data.id
                $('#brandname').val(data.brandname);

                $('#status').val(data.status);

            },

            error: function (xhr, status, error) {
                alert(xhr);
                console.log(xhr.responseText);

                $.alert({
                    title: 'Fail!',
                    //            content: xhr.responseJSON.errors.product_code + '<br>' + xhr.responseJSON.msg,
                    type: 'red',
                    autoClose: 'ok|2000'

                });
            }
        });
    } //editVendorDetials function end

     */




</script>
</body>
</html>
