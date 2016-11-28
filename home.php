<html>

    <head>
        <title>Oxfam</title>

        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom-home.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green-min.png"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
        
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="resources/Oxfam_Circle_Green-min.png" id="symbol" width="50" height="50" />
                </div>

                <form class="navbar-form navbar-right">
                    <div class="input-group has-feedback search-bar-wrapper">
                        <input type="text" class="form-control search-bar" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>

                <ul class="nav navbar-nav pull-left" style="padding-left: 100px; word-spacing: 100px;">
                    <li class="active"><a href="#">DASHBOARD</a></li>
                    <li><a href="#">ORDERS</a></li>
                    <li><a href="#">INVENTORY</a></li> 
                    <li><a href="#">SUPPLIERS</a></li> 
                </ul>

            </div>
        </nav>

        <div class="container-fluid">
            <div class="row text-center top-bar">
                <div class="col-sm-2 top-notif new">
                    <p class="top-notif-number">10</p>
                    <p class="top-notif-desc">New Orders</p>
                </div>
                <div class="col-sm-2 top-notif pending" >
                    <p class="top-notif-number">90</p>
                    <p class="top-notif-desc">Pending Orders</p>

                </div>
                <div class="col-sm-2 top-notif  new" >
                    <p class="top-notif-number">20</p>
                    <p class="top-notif-desc">New Shipments</p>
                </div>
                <div class="col-sm-2 top-notif pending" >
                    <p class="top-notif-number ">80</p>
                    <p class="top-notif-desc">Pending Shipments</p>
                </div>
            </div>
        </div>

        <div class="container-fluid"  >
            <div class="row order-list-wrapper" >
                <div class="col-sm-6 order-list" >
                    <div class="container-fluid order-list-top">
                        <div class="col-sm-5  ">
                            <div class="dropdown">
                                <button class="btn btn-defualt dropdown-toggle" type="button" data-toggle="dropdown">All Orders
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Not Proccesed</a></li>
                                    <li><a href="#">Processed</a></li>
                                    <li><a href="#">Delivered</a></li>
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
                        <a href="#" class="list-group-item order-list-item" >
                            <div class="row" >
                                <div class="col-sm-2 profile-picture-wrapper" >
                                    <img class="profile-picture center-block" src="resources/Oxfam_Circle_Green-min.png" id="symbol" />
                                </div>
                                <div class="col-sm-3" >
                                    <div class="row" >
                                        <div class="col-sm-12 name">
                                            Cedric Angelo Plasabas
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-sm-12 description" >
                                            Block 22 Lot 7, Calle de Teresita, Fuente de Villa-Abrille, Tulip Drive, Juna Subdv, Brgy. Matina Crossing, Davao City
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4  orders" >
                                    <div class="row  text-center">
                                        <div class="col-sm-6">Orange</div>
                                        <div class="col-sm-4">x2</div>
                                    </div>
                                    <div class="row  text-center">
                                        <div class="col-sm-6">Banana</div>
                                        <div class="col-sm-4">x5</div>
                                    </div>
                                    <div class="row  text-center">
                                        <div class="col-sm-6">Orange</div>
                                        <div class="col-sm-4">x3</div>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center status">
                                    Not Processed
                                </div>
                            </div>
                        </a>
                    </div>
                    <button type="submit" name="add" class="btn btn-default more-order-list-item text-center center-block ">
                        SHOW MORE ORDERS
                    </button>
                </div>
            </div>
        </div>


    </body>

 
</html>