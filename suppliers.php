<html>

    <head>
        <title>Oxfam</title>


        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom-home.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/css/mdb.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green-min.png"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/js/mdb.min.js"></script>

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
                    <li  ><a href="orders.php" >ORDERS</a></li>
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
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#add_supplier_modal"> <span class="glyphicon glyphicon-plus"></span> NEW
            </button>
            <div class="input-group has-feedback search-bar-wrapper pull-right">
                <input type="text" class="form-control search-bar" placeholder="Find Supplier">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>


        <div class="container-fluid " id="supplier-list" style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <div class="row">
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
                                    <button type="button" class="close" data-toggle="modal" data-target="#delete_supplier_modal" >&times;</button>
                                    <div class="row" style="padding: 50px 0 50px 0;">
                                        <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid center-block">
                                    </div>
                                    <div class="row text-center" style="font-weight: bold; font-size: 24px;padding-bottom: 50px;">
                                        <div class="col-sm-12">
                                            <?php echo $company; ?>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-bottom: 15px;">
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
                                    <div class="row" style="padding-bottom: 15px;">
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
                                                                <button type="button" class="close" data-toggle="modal" data-target="#delete_item_modal" >&times;</button>                                              
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
                                        <button class="btn btn-default  " type="button"  data-toggle="modal" data-target="#add_item_modal"> 
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
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Supplier</h4>
                    </div>
                    <div class="modal-body"  >
                        <form method="POST" action="add_supplier.php"  style="margin: 0 50px 0 50px ;">
                            <div class="row" >
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fname" placeholder="First Name"/>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" name="add_supplier">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="delete_supplier_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Supplier</h4>
                    </div>
                    <div class="modal-body text-center"  >
                        <form method="POST" action="delete_supplier.php"  style="margin: 0 50px 0 50px ;">
                            <p>Are you sure you want to remove supplier?</p>
                            <button type="button" class="btn btn-danger " name="delete_supplier">Delete</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_item_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Supplier</h4>
                    </div>
                    <div class="modal-body text-center"  >
                        <form method="POST" action="add_item.php"  style="margin: 0 50px 0 50px ;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" placeholder="Name"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="desc" placeholder="Description"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dimention" placeholder="Dimentions"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Unit" placeholder="Unit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" name="add_item">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete_item_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Item</h4>
                    </div>
                    <div class="modal-body text-center"  >
                        <form method="POST" action="delete_item.php"  style="margin: 0 50px 0 50px ;">
                            <p>Are you sure you want to remove produce?</p>
                            <button type="button" class="btn btn-danger " name="delete_supplier">Delete</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
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
                var max = document.getElementById("order-list").getElementsByTagName("a").length;
                max += 1;
                var orders = '';
                $.ajax({
                    type: "POST",
                    url: "more-suppliers.php",
                    data: {max: max},
                    dataType: "json",
                    success: function (response) {
                        orders += response;
                        $('.supplier-list').append(orders);
                        $('.supplier-list').find(".supplier-list-item").slideDown("fast");
                        checkorders();
                    },
                    error: function (thrownError) {
                        alert(thrownError);
                    }
                });
            };





        </script>

    </body>





</html>