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
                    <li ><a href="store.php"  >STORE</a></li> 
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

        <div class="container-fluid " style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <table class="table" style="">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class=" text-center">Price</th>
                        <th class=" text-center">Unit</th>
                        <th class=" text-center">In Store</th>
                        <th class=" text-center">In Storage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-3" >
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="col-sm-4">
                                    <h5><strong>Sportswear</strong></h5>
                                    <p class="text-muted">by FifeSteps</p>
                                </div>

                            </div>
                        </td>
                        <td class="col-md-2 text-center">Php 1,200.00</td>
                        <td class=" text-center">Box</td>
                        <td class=" text-center">100</td>
                        <td class=" text-center">0</td>
                    </tr>


                </tbody>
            </table>
        </div>
    </body>


</html>