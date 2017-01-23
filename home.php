<html>

    <head>
        <title>Oxfam</title>

        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom-home.css" rel="stylesheet" type="text/css"/>
        <link href="css/mdb.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.0.0.min.js" type="text/javascript"></script>   
        <script src="js/mdb.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" type="image/png" href="images/women's-market-logo.png"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>


        <?php
        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: index.php");
        }
        require_once 'config.php';

        $new_orders = 0;
        $pending_orders = 0;
        $returned_orders = 0;


        $q = $mysql->query("select * from orders");
        if ($q->num_rows > 0) {
            while ($row = $q->fetch_assoc()) {
                if ($row['status'] == 0) {
                    $new_orders += 1;
                } else if ($row['status'] == 1) {
                    $pending_orders += 1;
                } else if ($row['status'] == 2) {
                    $returned_orders += 1;
                }
            }
        }
        ?>
    </head>
    <body >
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="images/women's-market-logo.png" class="symbol" />
                </div>

                <ul class="nav navbar-nav ">
                    <li class="active" ><a href="home.php">DASHBOARD</a></li>
                    <li><a href="orders.php" >ORDERS</a></li>
                    <li><a href="inventory.php"  >INVENTORY</a></li> 
                    <li><a href="suppliers.php"  >SUPPLIERS</a></li> 
                    <li><a href="reports.php"  >REPORTS</a></li> 
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span></a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span></a></a></li>
                </ul>

            </div>
        </nav>

        <div class="container-fluid" >
            <div class="row text-center top-bar">
                <div class="col-sm-2 top-notif new">
                    <p class="top-notif-number"><?php echo $new_orders; ?></p>
                    <p class="top-notif-desc">New Orders</p>
                </div>
                <div class="col-sm-2 top-notif pending" >
                    <p class="top-notif-number"><?php echo $pending_orders; ?></p>
                    <p class="top-notif-desc">Pending Orders</p>

                </div>
                <div class="col-sm-2 top-notif  new" >
                    <p class="top-notif-number"><?php echo $returned_orders; ?></p>
                    <p class="top-notif-desc">Returned Orders</p>
                </div>
            </div>
        </div>

        <div class="container-fluid"  >
            <div class="row order-list-wrapper" >
                <div class="col-sm-7" >
                    <div class="container-fluid order-list-top">
                        <div class="col-sm-5  ">
                            <div class="dropdown">

                                <button class="order-list-btn btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders
                                </button>
                                <ul class="dropdown-menu">
                                    <li ><a>Not Processed</a></li>
                                    <li ><a >Processed</a></li>
                                    <li><a >Returned</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            Orders
                        </div>
                        <div class="col-sm-3 text-center">
                            Status
                        </div>
                    </div>
                    <div class="list-group order-list" id="order-list">
                        <?php
                        $name = "";
                        $status = "0";
                        $address = "";
                        $order_id = 0;

                        if (isset($_GET['status'])) {
                            $status = $_GET['status'];
                        }

                        $order_list_q = $mysql->query("select orders.id,customer.fname , customer.lname,customer.address, orders.status from customer left join orders on orders.customer_id = customer.user_id where orders.status = $status limit 5;");
                        if ($order_list_q->num_rows > 0) {
                            while ($row = $order_list_q->fetch_assoc()) {
                                $order_id = $row['id'];
                                $name = $row['fname'] . " " . $row['lname'];
                                $address = $row['address'];

                                if ($row['status'] == 0) {
                                    $status = "Not Processed";
                                } else if ($row['status'] == 1) {
                                    $status = "In Transit";
                                } else if ($row['status'] == 2) {
                                    $status = "Delivered";
                                } else if ($row['status'] == 3) {
                                    $status = "Return";
                                }
                                ?>
                                <a href="#" class="list-group-item order-list-item" data-id="<?php echo $order_id; ?>" data-toggle="modal" data-target="#process_order_modal">
                                    <div class="row" >
                                        <div class="col-sm-2 profile-picture-wrapper" >
                                            <img class="profile-picture center-block" src="resources/Oxfam_Circle_Green-min.png" id="symbol" />
                                        </div>
                                        <div class="col-sm-3" >
                                            <div class="row" >
                                                <div class="col-sm-12 name">
                                                    <?php echo $name; ?>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-sm-12 description" >
                                                    <?php echo $address; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 orders" >

                                            <?php
                                            $order_items_q = $mysql->query("select item.name, item.unit, order_items.quantity from item left join order_items on order_items.item_id = item.id where order_items.order_id = $order_id;");
                                            if ($order_items_q->num_rows > 0) {
                                                $item_name = "";
                                                $item_quantity = "";
                                                while ($row = $order_items_q->fetch_assoc()) {
                                                    $item_name = $row['name'];
                                                    $item_quantity = $row['quantity'] . " " . $row['unit'];
                                                    if ($row['quantity'] >= 2) {
                                                        $item_quantity = $item_quantity . "es";
                                                    }
                                                    ?>
                                                    <div class="row text-center">
                                                        <div class="col-sm-6">
                                                            <?php echo $item_name; ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php echo $item_quantity; ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                        <div class="col-sm-3 text-center status">
                                            <?php echo $status; ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="container-fluid text-center  center-block" style="padding: 50px 0 50px 0;">
                        <button type="submit" id="show-more" class="btn btn-default more-order-list-item hidden ">
                            SHOW MORE ORDERS
                        </button>
                        <p class="lead text-muted" id="no-more hidden">
                            NO MORE ORDERS TO SHOW
                        </p>
                    </div>
                </div>

                <div class=" col-sm-3 col-sm-offset-1" >
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center" style="font-weight: bold; font-size: 16px;">Top Sellers</div>
                            <div class="panel-body" >
                                <div class="row" style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        1. Orange
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        60%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        2. Apple
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        20%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        3. Lemon
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        13%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        4. Lettuce
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        7%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center" style="font-weight: bold; font-size: 16px;">Top Customers</div>
                            <div class="panel-body">
                                <div class="row" style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        1. Oxfam
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        60%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        2. Oxfam
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        20%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        3. Oxfam
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        13%
                                    </div>
                                </div>
                                <div class="row " style="padding: 10px 0 10px 0;">
                                    <div class="col-sm-6" style="padding: 0 50px 0 75px;">
                                        4. Oxfam
                                    </div>
                                    <div class="col-sm-4" style="padding: 0 50px 0 75px;">
                                        7%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="process_order_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="process_order_form" action="process_order.php" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Deliver Order</h4>
                        </div>
                        <div class="modal-body text-center"  style="margin: 0 50px 0 50px ;" >
                            <input type="hidden" class="form-control" id="id"  name="id" />
                            <p>Deliver Order?</p>
                            <button type="submit" class="btn btn-default process_order " id="process_order" name="deliver">Deliver</button>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </body>

    <script>

        window.onload = function () {
            checkorders();

            var url_status = /status=([^&]+)/.exec(window.location.href)[1];
            var status = url_status ? url_status : 'status';
            if (status === "0") {
                $(".order-list-btn:first-child").text("Not Processed");
            } else if (status === "1") {
                $(".order-list-btn:first-child").text("Processed");
            } else if (status === "3") {
                $(".order-list-btn:first-child").text("Returned");
            }
        };



        $(".dropdown-menu").on('click', 'li a', function () {
            $(".order-list-btn:first-child").text($(this).text());
            var sel = $(this).text();

            if (sel === "Not Processed") {
                window.location.replace("home.php?status=0");
            } else if (sel === "Processed") {
                window.location.replace("home.php?status=1");
            } else if (sel === "Returned") {
                window.location.replace("home.php?status=3");
            }
        });


        function checkorders() {
            var max = document.getElementById("order-list").getElementsByTagName("a").length;

            $.ajax({
                type: "POST",
                url: "check-orders.php",
                data: {max: max},
                dataType: "json",
                success: function (response) {
                    if (response === 0) {
                        $("#show-more").hide();
                        $("#no-more").show();

                    } else {
                        $("#no-more").hide();
                        $("#show-more").show();
                    }
                },
                error: function (thrownError) {
                    alert(thrownError);
                }
            });

        }

        document.getElementById("show-more").onclick = function () {
            var max = document.getElementById("order-list").getElementsByTagName("a").length;
            var multiplier = Math.round(max / 5) + 1;
            var limit = multiplier * 5;
            var orders = '';
            $.ajax({
                type: "POST",
                url: "more-orders.php",
                data: {max: max, limit: limit},
                dataType: "json",
                success: function (response) {
                    orders += response;
                    $('.order-list').append(orders);
                    $('.order-list').find(".list-group-item").slideDown("fast");
                    checkorders();
                },
                error: function (thrownError) {
                    alert(thrownError);
                }
            });
        };


        $(document).on("click", ".order-list-item", function () {
            var id = $(this).data('id');
            $(".modal-body #id").val(id);
        });

        $("#process_order_form").on("submit", function (e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");

            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data) {
                    $('#process_order_form .modal-header .modal-title').html("");
                    $('#process_order_form .modal-body').html(data);
                    $("#process_order").remove();

                },
                error: function (status, error) {
                    console.log(status + ": " + error);
                }
            });
            e.preventDefault();
        });

        $('#process_order_modal').on('hidden.bs.modal', function () {
            location.reload();
        });


    </script>



</html>