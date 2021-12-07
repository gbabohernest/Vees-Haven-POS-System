<?php include("header.php") ?>
<!--new vendor -->
<div class="container-fluid">
    <div class="row">
        <!-- add vendor -->
        <div class="col-sm-12">
            <div class="card mt-1 ">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Add Vendor</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <form id="form-vendor" >
                        <div class="form-row">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="vendor_name">Vendor Name</label>
                                    <input type="text" id="vendor_name" class="form-control" name="vendor_name"
                                           placeholder="vendor name"
                                           required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="contact_no">Contact No</label>
                                    <input type="text" id="contact_no" class="form-control" name="contact_no"
                                           placeholder="contact number"
                                           required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control" name="email"
                                           placeholder="email"
                                           required>
                                </div>
                            </div> <!--first row end-->
                            <br>

                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" class="form-control"
                                           name="address" placeholder="address"
                                           required>
                                </div>
                                <div class="form-group col-sm-4">
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
                            <button type="button" class="btn btn-outline-primary" id="save" onclick="addVendor()">Add
                            </button>
                            <button type="button" class="btn btn-outline-danger"   id="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--new vendor ends-->

<!--vendor table-->
<  <div class="col-sm-12">
    <div class="card mt-1">
        <div class="card-header">
            <div class="card-title">
                <h4 class="text-center">All Vendors</h4>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive table-striped " id="table-vendor" style="width:100%">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
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
<!--vendor table end-->

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

    let isNew = true;
    displayVendorDataInTable();
    let vendorID = null;


    function addVendor() {
        if ($("#form-vendor").valid()) {
            let _url = "";
            let _data = "";
            let _method;

            if (isNew === true) {
                _url = '../php/vendor/add_vendor.php';
                _data = $("#form-vendor").serialize();
                _method = "POST";

            }
            else {
                //update the edited category
                _url = '../php/vendor/update_vendor.php';
                _data = $("#form-vendor").serialize() + "& vendorID=" + vendorID;
                _method = "POST";
            }

            $.ajax({
                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                //display success message
                success: function (data) {
                    displayVendorDataInTable();
                    let msg;

                    if (isNew) {
                        msg = "<h6 class='text-center fw-bold'> Vendor Created</h6>"
                    } 
                    else {
                        msg = "<h6 class='text-center fw-bold'>Vendor Updated</h6>"
                    }

                    $.alert({
                        title: '<h4 class="fw-bold ">Success!</h4>',
                        content: msg,
                        type: 'green',
                        boxWidth: '400px',
                        theme: 'light',
                        useBootstrap: true,
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
    } //    end of add vendor fun


    function displayVendorDataInTable() {
        let vendorTable = $('#table-vendor').DataTable()
        vendorTable.clear().draw();
        $.ajax({
            url: "../php/vendor/all_vendor.php",
            type: "GET",
            dataType: "JSON",


            success: function (data) {

                $('#table-vendor').dataTable({
                    "bDestroy": true,
                    "aaData": data,
                    "scrollX": true,
                    "scrollY": true,

                    "aoColumns": [
                        {"sTitle": "Vendor Name", "mData": "vendor_name"},
                        {"sTitle": "Contact ", "mData": "contact_no"},
                        {"sTitle": "Email", "mData": "email"},
                        {"sTitle": "Address", "mData": "address"},

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
                            "mData": "vendor_id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-primary" onclick="editVendorDetails(' + mData + ')">Edit</button>';
                            }
                        },
                        {
                            "sTitle": "Delete",
                            "mData": "vendor_id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-danger" onclick="deleteVendor(' + mData + ')">Delete</button>';
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
    } //displayVendorDataInTable function end


    //    edit function
    function editVendorDetails(id) {
        $.ajax({
            type: "POST",
            url: "../php/vendor/editVendor_return.php",
            dataType: "JSON",
            data: {vendorID: id},

            success: function (data) {
                $("html, body").animate({scrollTop: 0}, "slow");
                isNew = false
                // console.log(data);

                vendorID = data.id
                $('#vendor_name').val(data.vendor_name);
                $('#contact_no').val(data.contact_no);
                $('#email').val(data.email);
                $('#address').val(data.address);
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
    } //editVendorDetails function end



    function deleteVendor(id) {
        $.confirm({
            theme: 'supervan',
            buttons: {
                Yes: function () {
                    $.ajax({
                        type: "POST",
                        url: "../php/vendor/delete_vendor.php",
                        dataType: "JSON",
                        data: {vendorID: id},

                        success: function (data) {
                            displayVendorDataInTable();
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
    } //deleteVendor end

</script>
</body>
</html>
