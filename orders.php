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
                    <li  class="active"><a href="orders.php" >ORDERS</a></li>
                     <li ><a href="store.php"  >STORE</a></li> 
                    <li ><a href="inventory.php"  >INVENTORY</a></li> 
                    <li><a href="suppliers.php"  >SUPPLIERS</a></li> 
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
                ORDER LIST
            </div>
        </div>

        <div class="container-fluid" style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <div class="row " >
                <div class="col-sm-12 orders-order-list" >
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
                    <div class="list-group" >
                        <?php
                        $name = "";
                        $address = "";
                        $status = "";
                        $order_id = 0;

                        $order_list_q = $mysql->query("select orders.id,customer.fname , customer.lname,customer.address, orders.status from customer left join orders on orders.customer_id = customer.id limit 5;");
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
                                <a href="#" class="list-group-item order-list-item" >
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
                </div>
            </div>


            <div class="container-fluid text-center" >
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>



    </body>


</html>