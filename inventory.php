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
                    <li><a href="orders.php" >ORDERS</a></li>
                    <li  class="active"><a href="inventory.php"  >INVENTORY</a></li> 
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

        <div class="container-fluid text-center " style="padding-top:50px; font-size: 45px;font-weight: bold;">
            <div class="row">
                INVENTORY
            </div>
        </div>

        <div class="container-fluid" style="padding: 50px 100px 0 100px;">
            <div class="input-group has-feedback search-bar-wrapper pull-right">
                <input type="text" class="form-control search-bar" placeholder="Find Produce">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>


        <div class="container-fluid " style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <table class="table" style="">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class=" text-center">Price</th>
                        <th class=" text-center">Unit</th>
                        <th class=" text-center">In Stock</th>
                        <th class=" text-center">Add Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item_id = 0;
                    $item_name = "";
                    $item_price = "";
                    $supplier_company = "";
                    $item_description = "";
                    $item_dimensions = "";
                    $item_unit = "";
                    $inventory_quantity = 0;

                    $item_list_q = $mysql->query("select item.id,supplier.company_name,item.name,item.price,item.description,item.dimensions,item.unit, inventory.quantity from item left join supplier on item.supplier_id = supplier.id left join inventory on inventory.item_id = item.id limit 5");
                    
                    if ($item_list_q->num_rows > 0) {
                        while ($row = $item_list_q->fetch_assoc()) {
                            $item_id = $row['id'];
                            $item_name = $row['name'];
                            $item_price = $row['price'];
                            $supplier_company = $row['company_name'];
                            $item_description = $row['description'];
                            $item_dimensions = $row['dimensions'];
                            $item_unit = $row['unit'];
                            $inventory_quantity = $row['quantity'];
                            ?>

                            <tr>
                                <td class="col-md-3" >
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-sm-4">
                                            <h3><strong><?php echo $item_name;?></strong></h3>
                                            <p class="text-muted"><?php echo $supplier_company;?></p>
                                        </div>

                                    </div>
                                </td>
                                <td class="col-md-2 text-center"><?php echo $item_price;?></td>
                                <td class=" text-center"><?php echo $item_unit;?></td>
                                <td class=" text-center"><?php echo $inventory_quantity;?></td>
                                <td class=" text-center"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#add_supplier_modal"> 
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>


</html>