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
                }else if ($row['status'] == 2) {
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
                    <img src="resources/Oxfam_Circle_Green-min.png" class="symbol" />
                </div>

                <ul class="nav navbar-nav ">
                    <li class="active" ><a href="home.php">DASHBOARD</a></li>
                    <li><a href="orders.php" >ORDERS</a></li>
                    <li><a href="inventory.php"  >INVENTORY</a></li> 
                    <li><a href="suppliers.php"  >SUPPLIERS</a></li> 
                    <li><a href="reports.php"  >REPORTS</a></li> 
                </ul>



                <form class="navbar-form navbar-right">
                    <div class="input-group has-feedback search-bar-wrapper">
                        <input type="text" class="form-control search-bar" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>

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
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Not Proccesed
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Processed</a></li>
                                    <li><a href="#">Delivered</a></li>
                                    <li><a href="#">Returned</a></li>
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
                        $address = "";
                        $status = "";
                        $order_id = 0;

                        $order_list_q = $mysql->query("select orders.id,customer.fname , customer.lname,customer.address, orders.status from customer left join orders on orders.customer_id = customer.id where orders.status = 0 limit 5;");
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
                                <a href="#" class="list-group-item order-list-item"  >
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
                    <div class="container-fluid " style="padding-top: 30px;">
                        <button type="submit" id="show-more" class="btn btn-default more-order-list-item text-center  center-block">
                            SHOW MORE ORDERS
                        </button>
                        <p class="lead text-muted text-center" id="no-more">
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

                </div>
            </div>
        </div>


    </body>

    <script>

        window.onload = function () {
            $("#no-more").hide();
            checkorders();
        };

        function checkorders() {
            var max = document.getElementById("order-list").getElementsByTagName("a").length;
            $.ajax({
                type: "POST",
                url: "check-orders.php",
                data: {max: max},
                dataType: "json",
                success: function (response) {
                    if(response === 0){
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
                url: "more-orders.php",
                data: {max: max},
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





    </script>



</html>