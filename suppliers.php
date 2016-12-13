<?php ?>
<html>

    <head>
        <title>Oxfam</title>


        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom-home.css" rel="stylesheet" type="text/css"/>
           <link href="css2/mdb.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green-min.png"/>
    

      <script src="js2/bootstrap.min.js" type="text/javascript"></script>
        <script src="js2/jquery.min.js" type="text/javascript"></script>
        <script src="js2/mdb.min.js" type="text/javascript"></script>

        <?php
        session_start();

        $mysql = new mysqli("localhost", "root", "", "oxfam");
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="resources/Oxfam_Circle_Green-min.png" class="symbol" />
                </div>

                <ul class="nav navbar-nav ">
                    <li ><a href="home.php">DASHBOARD</a></li>
                   <!--    <li><a href="orders.php" >ORDERS</a></li>-->    
                    <li ><a href="inventory.php"  >INVENTORY</a></li> 
                    <li class="active"><a href="suppliers.php"  >SUPPLIERS</a></li> 
                    <li ><a href="reports.php"  >REPORTS</a></li> 
                </ul>



                <form class="navbar-form navbar-right">
                    <div class="input-group has-feedback search-bar-wrapper">
                        <input type="text" class="form-control search-bar" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>

            </div>
        </nav>

        <div class="container-fluid text-center " style="padding-top:50px; font-size: 45px;font-weight: bold;">

            <div class="row">
                SUPPLIERS

            </div>
        </div>



        <div class="container-fluid" style="padding: 50px 100px 0 100px;">
            <button class=" btn btn-default"  type="button" data-toggle="modal" data-target="#add_supplier_modal"> 
                <span class="glyphicon glyphicon-plus"></span> NEW
            </button>
            <div class="input-group has-feedback search-bar-wrapper pull-right">
                <input type="text" class="form-control search-bar" placeholder="Find Supplier">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>


        <div class="container-fluid" id="supplier-list" style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <div class="row ">
                <?php
                $supplier_id = 0;
                $company = "";
                $name = "";
                $owner = "";
                $age = "";
                $address = "";
                $sex = "";

                $supplier_list_q = $mysql->query("select * from supplier limit 3");
                if ($supplier_list_q->num_rows > 0) {
                    while ($row = $supplier_list_q->fetch_assoc()) {
                        $supplier_id = $row['id'];
                        $company = $row['company_name'];
                        $name = $row['fname'] . " " . $row['lname'];
                        $age = $row['age'];
                        $address = $row['address'];
                        $sex_num = $row['sex'];


                        if ($sex_num == 0) {
                            $sex = "Male";
                        } else {
                            $sex = "Female";
                        }
                        ?>
                        <div class="col-sm-4">
                            <div class="panel panel-default supplier-list-item">
                                <div class="panel-heading " >
                                    <button type="button" class="close delete_supplier_btn" data-id="<?php echo $supplier_id; ?>" data-toggle="modal" data-target="#delete_supplier_modal" >&times;</button>
                                    <div class="row" style="padding: 50px 0 50px 0;">
                                        <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid center-block">
                                    </div>
                                    <div class="row text-center" style="font-weight: bold; font-size: 24px;padding-bottom: 50px;">
                                        <div class="col-sm-12">
                                            <?php echo $company; ?>
                                        </div>
                                    </div>

                                    <div class="row" style="padding: 0 0 15px 40px ;">
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Owner:
                                        </div>
                                        <div class="col-sm-5">
                                            <?php echo $name; ?>
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Age:
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo $age; ?>
                                        </div>                            </div>
                                    <div class="row" style="padding: 0 0 15px 40px ;">
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Address:
                                        </div>
                                        <div class="col-sm-5">
                                            <?php echo $address; ?>
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Sex:
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo $sex; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row text-center" style="font-weight: bold; font-size: 14px; padding: 20px 0 20px 0;">
                                        <div class="col-sm-12">
                                            PRODUCE
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 0 30px 0 30px;">
                                        <?php
                                        $item_id = 0;
                                        $item_name = "";
                                        $item_desc = "";
                                        $item_dimensions = "";
                                        $item_unit = "";

                                        $item_check_q = $mysql->query("select * from item where supplier_id =  $supplier_id");
                                        if ($item_check_q->num_rows > 0) {
                                            ?>
                                            <table class="table" >
                                                <thead style="font-size: 12px;">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th class=" text-center">Description</th>
                                                        <th class=" text-center">Dimensions</th>
                                                        <th class=" text-center">Unit</th>
                                                        <th class=" text-center"> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = $item_check_q->fetch_assoc()) {
                                                        $item_id = $row['id'];
                                                        $item_name = $row['name'];
                                                        $item_desc = $row['description'];
                                                        $item_dimensions = $row['dimensions'];
                                                        $item_unit = $row['unit'];
                                                        ?>
                                                        <tr>
                                                            <td class="col-md-3" ><?php echo $item_name; ?></td>
                                                            <td class="col-md-2 text-center"><?php echo $item_desc; ?></td>
                                                            <td class=" text-center"><?php echo $item_dimensions; ?></td>
                                                            <td class=" text-center"><?php echo $item_unit; ?></td>
                                                            <td class=" text-center">
                                                                <button type="button" class="delete_item_btn close" data-id="<?php echo $item_id; ?>" data-toggle="modal" data-target="#delete_item_modal" >&times;</button>                                              
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="container-fluid">
                                                <p class="lead text-muted text-center">
                                                    NO PRODUCE REGISTERED
                                                </p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="panel-footer ">
                                    <div class="container-fluid text-center">
                                        <button class="add_item_btn btn btn-default" data-id="<?php echo $supplier_id; ?>" type="button"  data-toggle="modal" data-target="#add_item_modal"> 
                                            <span class="glyphicon glyphicon-plus"></span> ADD PRODUCE
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>


        <div class="container-fluid text-center  center-block" style="padding: 50px 0 50px 0;">
            <button type="submit" id="show-more" class="btn btn-default more-order-list-item ">
                SHOW MORE SUPPLIERS
            </button>
            <p class="lead text-muted text-center" id="no-more">
                NO MORE SUPPLIERS TO SHOW
            </p>
        </div>



        <div class="modal fade" id="add_supplier_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="add_supplier_form" action="add_supplier.php"  >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Supplier</h4>
                        </div>
                        <div class="modal-body" style="margin: 0 50px 0 50px ;"  >

                            <div class="row" >
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="age" placeholder="Age"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="sex" placeholder="Sex"/>
                                </div>
                            </div>
                            <div class="row">
                                <input type="textbox" class="form-control" name="address" placeholder="Address"/>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" id="add_supplier" name="add_supplier">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="delete_supplier_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="delete_supplier_form" action="delete_supplier.php"  style="margin: 0 50px 0 50px ;">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Supplier</h4>
                        </div>
                        <div class="modal-body text-center"  >

                            <input type="hidden" class="form-control" id="id"  name="id" />
                            <p>Are you sure you want to remove supplier?</p>
                            <p class="text-danger">WARNING: All of its produce and stock will be removed also</p>
                            <button type="submit" class="btn btn-danger " id="delete_supplier" name="delete_supplier">Delete</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="modal fade" id="add_item_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="add_item_form" action="add_item.php" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Produce</h4>
                        </div>
                        <div class="modal-body text-center"  style="margin: 0 50px 0 50px ;" >
                            <input type="hidden" class="form-control" id="id"  name="id" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="name" placeholder="Name"/>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">₱</span>
                                        <input type="number" class="form-control" name="price" placeholder="Price"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dimension" placeholder="Dimensions"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="unit" placeholder="Unit"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">      
                                <div class="col-xs-12">       
                                    <input type="text" class="form-control" name="desc" placeholder="Description"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" id="add_item" name="add_item">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="modal fade" id="delete_item_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="delete_item_form" action="delete_item.php" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Item</h4>
                        </div>
                        <div class="modal-body text-center"  style="margin: 0 50px 0 50px ;" >

                            <input type="hidden" class="form-control" id="id"  name="id" />
                            <p>Are you sure you want to remove produce?</p>
                            <p class="text-danger">WARNING: All of its stock will be removed also</p>
                            <button type="submit" class="btn btn-danger " id="delete_item" name="delete_supplier">Delete</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>





        <script>


            window.onload = function () {

                $("#no-more").hide();
                checkorders();
            };

            function checkorders() {
                var max = document.getElementById("supplier-list").getElementsByClassName("supplier-list-item").length;
                $.ajax({
                    type: "POST",
                    url: "check-suppliers.php",
                    data: {max: max},
                    dataType: "json",
                    success: function (response) {
                        if (response === 0) {
                            $("#show-more").hide();
                            $("#no-more").show();
                        }
                    },
                    error: function (thrownError) {
                        alert(thrownError);
                    }
                });

            }
            document.getElementById("show-more").onclick = function () {
                var max = document.getElementById("supplier-list").getElementsByClassName("supplier-list-item").length;
                var multiplier = Math.round(max / 3) + 1;
                var limit = multiplier * 3;
                max += 1;
                var suppliers = '';
                $.ajax({
                    type: "POST",
                    url: "more-suppliers.php",
                    data: {max: max, limit: limit},
                    dataType: "json",
                    success: function (response) {
                        suppliers += response;
                        $('#supplier-list').append(suppliers);
                        $('#supplier-list').find(".supplier-list-item-wrapper").slideDown("slow");
                        checkorders();
                    },
                    error: function (xhr) {
                        alert(xhr.responseText);
                    }
                });
            };



            $("#add_supplier_form").on("submit", function (e) {

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data) {
                        $('#add_supplier_form .modal-header .modal-title').html("");
                        $('#add_supplier_form .modal-body').html(data);
                        $("#add_supplier").remove();

                    },
                    error: function (status, error) {
                        console.log(status + ": " + error);
                    }
                });
                e.preventDefault();
            });

            $('#add_supplier_modal').on('hidden.bs.modal', function () {
                location.reload();
            });

            $(document).on("click", ".add_item_btn", function () {
                var id = $(this).data('id');
                $(".modal-body #id").val(id);
            });

            $("#add_item_form").on("submit", function (e) {

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data) {
                        $('#add_item_form .modal-header .modal-title').html("");
                        $('#add_item_form .modal-body').html(data);
                        $("#add_item").remove();

                    },
                    error: function (status, error) {
                        console.log(status + ": " + error);
                    }
                });
                e.preventDefault();
            });

            $('#add_item_modal').on('hidden.bs.modal', function () {
                location.reload();
            });

            $(document).on("click", ".delete_supplier_btn", function () {
                var id = $(this).data('id');
                $(".modal-body #id").val(id);
            });

            $("#delete_supplier_form").on("submit", function (e) {

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data) {
                        $('#delete_supplier_form .modal-header .modal-title').html("");
                        $('#delete_supplier_form .modal-body').html(data);
                        $("#delete_supplier").remove();

                    },
                    error: function (status, error) {
                        console.log(status + ": " + error);
                    }
                });
                e.preventDefault();
            });

            $('#delete_supplier_modal').on('hidden.bs.modal', function () {
                location.reload();
            });

            $(document).on("click", ".delete_item_btn", function () {
                var id = $(this).data('id');
                $(".modal-body #id").val(id);
            });

            $("#delete_item_form").on("submit", function (e) {

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data) {
                        $('#delete_item_form .modal-header .modal-title').html("");
                        $('#delete_item_form .modal-body').html(data);
                        $("#delete_item").remove();

                    },
                    error: function (status, error) {
                        console.log(status + ": " + error);
                    }
                });
                e.preventDefault();
            });

            $('#delete_item_modal').on('hidden.bs.modal', function () {
                location.reload();
            });







        </script>

    </body>





</html>