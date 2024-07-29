<?php
require("common.php");
if (isset($_SESSION['email'])) {
    header('location: products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup | Stop-Style Store</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var name = document.forms["signupForm"]["name"].value;
            var email = document.forms["signupForm"]["email"].value;
            var password = document.forms["signupForm"]["password"].value;
            var contact = document.forms["signupForm"]["contact"].value;
            var city = document.forms["signupForm"]["city"].value;
            var address = document.forms["signupForm"]["address"].value;

            var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var contactPattern = /^[0-9]{10}$/;

            if (!name.match(/^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$/)) {
                alert("Invalid name format.");
                return false;
            }

            if (!email.match(emailPattern)) {
                alert("Invalid email format.");
                return false;
            }

            if (!password.match(passwordPattern)) {
                alert("Password must be at least 8 characters long, include 1 uppercase letter, 1 lowercase letter, and numeric characters.");
                return false;
            }

            if (!contact.match(contactPattern)) {
                alert("Contact number must be exactly 10 digits.");
                return false;
            }

            if (city == "" || address == "") {
                alert("City and address fields cannot be empty.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid decor_bg" id="content">
        <div class="col-lg-4 col-md-6">
            <img src="img/signup1.jpg">
        </div>
        <div class="row">
            <div class="container">
                <div class="col-lg-4 col-lg-offset-3 col-md-6">
                    <h2>SIGN UP</h2>
                    <form name="signupForm" action="signup_script.php" method="POST" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input class="form-control" placeholder="Name" autofocus="on" name="name" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter a valid Email" name="email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            <?php if(isset($_GET['m1'])) echo $_GET['m1']; ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" required="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Contact (ex. 8444844863)" maxlength="10" size="10" name="contact" required="true">
                            <?php if(isset($_GET['m2'])) echo $_GET['m2']; ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="City" name="city" required="true">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Address" name="address" required="true">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
