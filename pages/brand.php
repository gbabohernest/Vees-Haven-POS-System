<?php include("header.php") ?>
<!--brand-->
<div class="container-fluid">
    <div class="row">
        <!-- add brand  form-->
        <div class="col-sm-4">
            <div class="card mt-1 ">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Add Brand</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <form id="form-brand" class="form-group row">
                        <div class="form-control">
                            <label for="brandname">Brand</label>
                            <input type="text" id="brandname" class="form-control" name="brandname" placeholder="Brand"
                                   required>
                        </div>
                        <div class="form-control">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Please Select</option>
                                <option value="active">Active</option>
                                <option value="de-active">De-Active</option>
                            </select>
                        </div>

                        <div class="mt-3 float-end">
                            <button type="button" class="btn btn-outline-danger float-end m-2" id="reset">Reset</button>
                            <button type="button" class="btn btn-outline-primary float-end m-2" id="save" onclick="addBrand()">Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  <!-- add brand  form end-->

        <div class="col-sm-8">
            <div class="card mt-1">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Brands</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive table-striped " id="table-brand"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of brand-->

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
    // $(document).ready(function(){

    let isNew = true;
    displayBrandDataInTable();
    let brandID = null;


    function addBrand() {
        if ($("#form-brand").valid()) {
            let _url = "";
            let _data = "";
            let _method;

            if (isNew === true) {
                _url = '../php/brand/add_brand.php';
                _data = $("#form-brand").serialize();
                _method = "POST";

            } else {
                //update the edited category
                _url = '../php/brand/update_brand.php';
                _data = $("#form-brand").serialize() + "& brandID=" + brandID;
                _method = "POST";
            }

            $.ajax({
                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                //display success message
                success: function (data) {
                    displayBrandDataInTable();
                    let msg;

                    if (isNew) {
                        msg = "<h6 class='fw-bold text-center'>Brand Created</h6>";
                    } else {
                        msg = "<h6 class='fw-bold text-center'>Brand Updated</h6>";
                    }

                    $.alert({
                        title: '<h4 class="fw-bold">Success!</h4>',
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
    } //    end of add brand fun


    function displayBrandDataInTable() {
        let brandTable = $('#table-brand').DataTable()
        brandTable.clear().draw();
        $.ajax({
            url: "../php/brand/all_brand.php",
            type: "GET",
            dataType: "JSON",


            success: function (data) {

                $('#table-brand').dataTable({
                    "bDestroy": true,
                    "aaData": data,
                    "scrollX": true,
                    "aoColumns": [
                        {"sTitle": "Brand", "mData": "brandname"},
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
                            "mData": "id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-sm btn-primary" onclick="editBrandDetials(' + mData + ')">Edit</button>';
                            }
                        },
                        {
                            "sTitle": "Delete",
                            "mData": "id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-sm btn-danger" onclick="deleteBrand (' + mData + ')">Delete</button>';
                            }
                        }
                    ]
                });

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
    } //displayBrandDataInTable function end


    //    edit function
    function editBrandDetials(id) {
        $.ajax({
            type: "POST",
            url: "../php/brand/editBrand_return.php",
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
    } //editBrandDetials function end


    function deleteBrand(id) {
        $.confirm({
            theme: 'supervan',
            buttons: {
                Yes: function () {
                    $.ajax({
                        type: "POST",
                        url: "../php/brand/delete_brand.php",
                        dataType: "JSON",
                        data: {brandID: id},

                        success: function (data) {
                            displayBrandDataInTable();
                            let deletemsg = "Brand Deleted";

                            $.alert({
                                title: 'Success!',
                                content: deletemsg,
                                type: 'green',
                                boxWidth: '400px',
                                theme: 'light',
                                useBootstrap: false,
                                autoClose: 'ok|2000'
                            });
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
                },
                No: function () {

                }
            }
        });
    } //deleteBrand end
</script>
</body>
</html>
