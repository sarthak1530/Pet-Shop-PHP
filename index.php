<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pet shop Management System</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">

                <div class="login-form">
                    <div class="">
                        <h3 style="background-color: #ffff;font-weight: bold;"><img src="images/1627478.png" height="30px" width="30px">&nbsp;&nbsp;Pet shop Management System</h3>
                        <hr>
                        </hr>
                    </div>
                    <form role="form" id="logform">
                        <div id="myalert" style="display:none;">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <center><span id="alerttext"></span></center>
                                </div>

                            </div>
                        </div>
                        <div id="myalert3" style="display:none;">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <center><span id="alerttext3"></span></center>
                                </div>

                            </div>
                        </div>

                        <div id="myalert2" style="display:none;">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <center><span id="alerttext2"></span></center>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" placeholder="Password" name="password" id="password" type="password">
                        </div>
                        <input class="form-control" name="status" id="status" type="hidden" value="Active">
                        <button type="button" id="loginbutton" class="btn btn-primary btn-flat m-b-30 m-t-30"><span id="logtext">Sign in</span></button><br><br>
                          <div>
                             <label class="pull-left">
                               <a href="registrationform.php" style="color:#2c6ed5"><u>I don't have an account yet!</u></a>
                            </label>

                        </div><br>
                    </form>
                   
                </div>
                 <footer class="alert alert-info align-content-center"><center>All right Reserved © 2024 Created By: Sarthak & Aman</center></footer>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/customer-login.js"></script>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>