<html>

    <head>
        <title>Oxfam</title>

        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green.png"/>

    </head>
    <body>
        <div class="page_wrapper">
            <div class="container-fluid">
                <img src="resources/Oxfam_Logo_White.png" id="symbol" width="500" height="500" />
                <form class="login" action="login.php" method="POST" >
                    <div class="row">
                        <div id="user_form" class="form-group ">
                            <input type="text" class="form-control" name="uname" placeholder="Userame"/>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div id="pass_form" class="form-group">
                            <input  type="password" class="form-control" name="pword" placeholder="Password"/>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-default  login_button">LOGIN</button>
                </form>
            </div>
        </div>
    </body>

    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/jquery-3.0.0.min.js" type="text/javascript"></script>

</html>