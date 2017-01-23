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
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="images/women's-market-logo.png" class="symbol" />
                </div>

                <ul class="nav navbar-nav ">
                    <li ><a href="home.php">DASHBOARD</a></li>
                    <li><a href="orders.php" >ORDERS</a></li> 
                    <li ><a href="inventory.php"  >INVENTORY</a></li> 
                    <li><a href="suppliers.php"  >SUPPLIERS</a></li> 
                    <li  class="active"><a href="reports.php"  >REPORTS</a></li> 
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span></a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span></a></a></li>
                </ul>


            </div>
        </nav>

    </body>


</html>