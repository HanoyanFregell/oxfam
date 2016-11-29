<html>

    <head>
        <title>Oxfam</title>

        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green-min.png"/>
        <script type="text/javascript">
            window.onload = function () {

                function GetURLParameter(sParam)
                {
                    var sPageURL = window.location.search.substring(1);
                    var sURLVariables = sPageURL.split('&');
                    for (var i = 0; i < sURLVariables.length; i++)
                    {
                        var sParameterName = sURLVariables[i].split('=');
                        if (sParameterName[0] === sParam)
                        {
                            return sParameterName[1];
                        }
                    }
                }

                var tech = GetURLParameter('error');
                if (tech === "1") {
                    document.getElementById("user_form").className += " has-error has-feedback";
                } else if (tech === "2") {
                    document.getElementById("pass_form").className += " has-error has-feedback";
                }
            };
        </script>
    </head>

    <body>
        <div class="page_wrapper">
            <div class="container-fluid">
                <img src="resources/Oxfam_Logo_White-min.png" id="symbol" width="500" height="500" />
                <form class="login" action="login.php" method="POST" >
                    <div class="row">
                        <div id="user_form" class="form-group ">
                            <input type="text" class="form-control" name="uname" placeholder="Userame"/>
                        </div>
                    </div>
                    <div class="row">
                        <div id="pass_form" class="form-group">
                            <input  type="password" class="form-control" name="pword" placeholder="Password"/>      
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-default  login_button">LOGIN</button>
                </form>
            </div>
        </div>
        <div class="footer">
            </div>
    </body>

    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/jquery-3.0.0.min.js" type="text/javascript"></script>

</html>