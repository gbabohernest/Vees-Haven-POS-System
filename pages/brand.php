<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap    -->
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
    <!-- jquery -->
    <!--    <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">-->
    <link rel="stylesheet" href="../components/jquery-confirm-v3.3.4/css/jquery-confirm.css">
    <!--    main css-->
    <link rel="stylesheet" href="../main.css">
    <!-- data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <link rel="stylesheet" href="../main.css">
    <title>Vee's Haven</title>
</head>
<body>
<?php include ("../header.php")?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 ">
            <form id="form-brand" class="form-horizontal">
                <!--                <h4 align="center">CREATE CATEGORY</h4>-->
                <div class="form-group">
                    <label for="brandname">Brand</label>
                    <input type="text" id="brandname" class="form-control" name="brandname" placeholder="Brand"
                           required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Please Select</option>
                        <option value="active">Active</option>
                        <option value="de-active">De-Active</option>
                    </select>
                </div>

                <div class="mt-2" align="right">
                    <button type="button" class="btn btn-primary" id="save"  onclick="addBrand()">Add
                    </button>
                    <button type="button" class="btn btn-danger" id="reset">Reset</button>
                </div>
            </form>


        </div>
        <!-- add category end -->

        <div class="col-sm-8">
            <!--           <h4 align='center'>LIST OF CATEGORY</h4>-->
            <div class="panel-body">
                <table class="table table-responsive table-bordered" cellspacing="0" width="100%"
                       id="table-brand">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
<!--end of category form -->


<!--scripts links-->
<script src="../components/jquery/jquery-3.6.0.js"></script>
<script src="../components/jquery/jquery-3.6.0.min.js"></script>
<script src="../components/jquery.validate.min.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
<!--<script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>-->
<script src="../components/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<!-- data table -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!--end of scripts links -->


<!--jquery script-->
<script>
    // $(document).ready(function(){

    let isNew = true;
    displayDataInTable();
    let categoryID = null;


    function addBrand() {
        if ($("#form-brand").valid()) {
            let _url = "";
            let _data = "";
            let _method;

            if (isNew === true) {
                _url = '../php/add_brand.php';
                _data = $("#form-brand").serialize();
                _method = "POST";

            } else {
                //update the edited category
                _url = '../php/update_brand.php';
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
                    // displayDataInTable();
                    let msg;

                    if (isNew) {
                        msg = "Brand Created"
                    } else {
                        msg = "Brand Updated"
                    }

                    $.alert({
                        title: 'Success!',
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
    } //    end of add category fun


    function displayBrandDataInTable() {
        // $('#table-category').dataTable().fnDestroy();
        $.ajax({
            url: "../php/all_brand.php",
            type: "GET",
            dataType: "JSON",


            success: function (data) {

                $('#table-brand').dataTable({
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
                                return '<button class="btn btn-xs btn-success" onclick="editBrandDetials(' + mData + ')">Edit</button>';
                            }
                        },
                        {
                            "sTitle": "Delete",
                            "mData": "id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-primary" onclick="deleteBrand (' + mData + ')">Delete</button>';
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
    } //displayDataInTable function end


    //    edit function
    function editCategoryDetials(id) {
        $.ajax({
            type: "POST",
            url: "../php/edit_return.php",
            dataType: "JSON",
            data: {categoryID: id},

            success: function (data) {
                $("html, body").animate({scrollTop: 0}, "slow");
                isNew = false
                // console.log(data);

                categoryID = data.id
                $('#catname').val(data.catname);

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
    } //editCategoryDetials function end


    function deleteCategory(id) {
        $.confirm({
            theme: 'supervan',
            buttons: {
                Yes: function () {
                    $.ajax({
                        type: "POST",
                        url: "../php/delete_category.php",
                        dataType: "JSON",
                        data: {categoryID: id},

                        success: function (data) {
                            // displayDataInTable();
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
    } //deleteCategory end


    // }); //document.ready function end


</script>
</body>
</html>
