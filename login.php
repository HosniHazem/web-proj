<?php
require("includes/common.php");
// Redirect the user to the products page if logged in.
if (isset($_SESSION['email'])) {
    header('location: products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Stop-Style Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function validateLoginForm() {
            var email = document.forms["loginForm"]["email"].value;
            var password = document.forms["loginForm"]["password"].value;
            var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;

            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>
    <div id="content">
        <div class="container-fluid decor_bg" id="login-panel">
            <div class="col-lg-4 col-md-6">
                <img src="img/yess.jpg">
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-3 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>LOGIN</h4>
                        </div>
                        <div class="panel-body">
                            <p class="text-warning"><i>Login to make a purchase</i></p>
                            <form name="loginForm" action="login_submit.php" method="POST" onsubmit="return validateLoginForm()">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" autofocus="on" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Login</button><br><br>
                                <?php if (isset($_GET['error'])) echo $_GET['error']; ?>
                            </form><br/>
                        </div>
                        <div class="panel-footer"><p>Don't have an account? <a href="signup.php">Register</a></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
