<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
    <!--j-table link-->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- main css    -->
    <link rel="stylesheet" href="../main.css">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
        <!--    add category form        -->
            <form class="form-horizontal" id="formCategory">
                <div class="form-group" align="left">
                    <label for="catname">Category</label>
                    <input type="text" id="catname" class="form-control" name="catname" placeholder="Category" required>
                </div>

                <div class="form-group" align="left">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="">Please Select</option>
                        <option value="active">Active</option>
                        <option value="de-active">De-Active</option>
                    </select>
                </div>
                <div align="right">
                    <button type="button" class="btn btn-info" id="save" onclick="addCategory()">Add</button>
                    <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
                </div>
            </form>
        <!--   add category form end         -->
        </div>
        <div class="col-sm-8">
        <!--  category table           -->
            <div class="panel-body">
                <table id="tbl-category" class="table table-responsive table-bordered" cellspacing="0" width="100%">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                </table>
            </div>

        </div>
    </div>
</div>
<!--scripts links-->
<script src="../components/jquery/dist/jquery.js"></script>
<script src="../components/jquery/dist/jquery.min.js"></script>
<script src="../components/jquery.validate.min.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>
<!--j-table link-->
<script src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
<!--end of scripts links -->


<!--jquery script-->
<script>
    let Isnew = true;
    getAll();
    let categoryId = null;

    //this function  will be use to create category
    function addCategory()
    {
        if($("#formCategory").valid()) {
            let _url = '';
            let _data = '';
            let _method;
        }
        /*else {

        }*/
        if(Isnew === true) {
               _url = '../php/add_category.php';
               _data = $("#formCategory").serialize();
               _method = "POST";

            }
            //edit  data
            else {
                _url = '../php/update_category.php';
                _data = $("#formCategory").serialize() + "& categoryId=" + categoryId;
                _method = "POST";
            }

        $.ajax({
            type : _method,
            data : _data,
            url  : _url,
            dataType : 'JSON',

            //display success message
            success : function(data) {
              let msg;

              if(Isnew){
                  msg = "Category Created";
              }
              else {
                  msg = "Category Updated";
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
              /*$.alert({
                  title : 'Success!',
                  content : msg,
                  type : 'GREEN',
                  boxWidth: '400px',
                  theme: ' light' ,
                  useBootstrap: true,
                  autoClose: 'ok|2000'
              });*/
            },
            //display error message
            error: function (xhr, status, error) {
                alert(xhr);
                console.log(xhr.responseText);

                $.alert({
                    title: 'Fail!',
                    //content: xhr.responseJSON.errors.product_cord + '<br>' + xhr.responseJSON.msg,
                    type : 'red',
                    autoClose : 'ok|2000'
                });
                $('#save').prop('disabled', false);
                $('#save').html('');
                $('#save').append('Save');
            }
        });
    }
    //category  creating function  ends


    //this will take the data from all category & display it in the data table
    function getAll() {
        $.ajax({
            url : "../php/all_category.php",
            type : "GET",
            dataType : "JSON",

            success:function (data){

                $('#tbl-category').dataTable ({
                    "aaData" : data,
                    "scrollX" : true,
                    "aoColumns" : [
                        {"sTitle" :  "Category", "mData": "catname"},
                        {
                            "sTitle": "Status", "mData": "status", "render": function (mData, type, row, meta)
                            {
                                if (mData === 'active') {
                                    return '<span class="label label-info">Active</span>';
                                }
                                else if(mData === 'de-active') {
                                    return '<span class = "label label-warning">De-active</span>';
                                }
                            }
                        },

                        {
                            "sTitle" : "Edit",
                            "mData" : "id",
                            "render" : function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-success" onclick="getCategoryDetails(' + mData + ')" >Edit</button>';
                            }

                        },
                        {
                            "sTitle" : "Delete",
                            "mData" : "id",
                            "render" : function (mData, type, row, meta) {
                                return '<button class="btn btn-xs btn-primary" onclick="RemoveTeam(' + mData + ')">Delete</button>';
                            }

                        }
                    ]
                });
            },

            error: function (xhr) {
                console.log('Request Status: ' + xhr.status );
                console.log('Status Text: ' + xhr.statusText);
                console.log(xhr.responseText);
                let text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                //console.log(text)
            }
        });
    } //display data in data table function ends

     //edit  category function (will fires when user click the edit button)
    function getCategoryDetails(id) {
        $.ajax({
            type : 'POST',
            url  : '../php/edit_return.php',
            dataType : 'JSON',
            data : {categoryId : id },

            success: function(data) {
                $("html, body").animate({scrollTop: 0}, "slow");
                Isnew = false
                categoryId = data.id
                $('#catname').val(data.catname);

                $('#status').val(data.status);
                // $('#formCategory').modal('show');
            },

            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    } //edit category function ends

</script>
</body>
</html>