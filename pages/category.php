<?php include("header.php") ?>

<div class="container-fluid">
    <div class="row">
        <!-- add category form-->
        <div class="col-sm-4">
            <div class="card mt-1 ">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Add Category</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <form id="form-category" class="form-group row" >
                        <div class="form-control">
                            <label for="catname">Category</label>
                            <input type="text" id="catname" class="form-control" name="catname" placeholder="Category"
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
                            <button type="button" class="btn btn-outline-primary float-end m-2" id="save" name="catname" onclick="addCategory()">Add
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>  <!-- add category  form end-->

        <div class="col-sm-8">
            <div class="card mt-1">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="text-center">Categories</h4>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-responsive table-striped "   id="table-category" style="width:100%">
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
<!--category end-->


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
    displayDataInTable();
    let categoryID = null;

    function addCategory() {
        if ($("#form-category").valid()) {
            let _url = "";
            let _data = "";
            let _method;

            if (isNew === true) {
                _url = '../php/category/add_category.php';
                _data = $("#form-category").serialize();
                _method = "POST";

            } else {
                //update the edited category
                _url = '../php/category/update_category.php';
                _data = $("#form-category").serialize() + "& categoryID=" + categoryID;
                _method = "POST";
            }

            $.ajax({
                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                //display success message
                success: function (data) {
                    let msg;
                    displayDataInTable();
                    if (isNew) {
                        msg = "<h6 class='fw-bold text-center'>Category Created</h6>";
                    } else {
                        msg = "<h6 class='fw-bold text-center'>Category Updated</h6>";
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
    } //    end of add category fun


    function displayDataInTable() {
        // $('#table-category').DataTable().fnDestroy();
        let categoryTable = $('#table-category').DataTable()
        categoryTable.clear().draw();
        $.ajax({
            url: "../php/category/all_category.php",
            type: "GET",
            dataType: "JSON",


            success: function (data) {

                $('#table-category').DataTable({
                     "bDestroy": true,
                    "aaData": data,
                    "scrollX": true,
                    "aoColumns": [
                        {"sTitle": "Category", "mData": "catname"},
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
                                return '<button class="btn btn-sm btn-primary" onclick="editCategoryDetials(' + mData + ')">Edit</button>';
                            }
                        },
                        {
                            "sTitle": "Delete",
                            "mData": "id",
                            "render": function (mData, type, row, meta) {
                                return '<button class="btn btn-sm btn-danger" onclick="deleteCategory (' + mData + ')">Delete</button>';
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
            url: "../php/category/edit_return.php",
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
                        url: "../php/category/delete_category.php",
                        dataType: "JSON",
                        data: {categoryID: id},

                        success: function (data) {
                            displayDataInTable();
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

</script>
</body>
</html>