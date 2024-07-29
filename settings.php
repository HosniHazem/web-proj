<?php
require_once("common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

// Fetch user details
$query = "SELECT name, email, contact, city, address FROM users WHERE email = '" . $_SESSION['email'] . "'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings | Life Style Store</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .thumbnail img {
            width: 100%; /* Make the image responsive */
            height: auto;
        }
        #settings-container {
            padding: 20px;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <img src="img/settings.jpg" class="img-responsive" alt="Settings">
            </div>
            <div class="col-lg-8 col-md-6" id="settings-container">
                <h4>User Details</h4>
                <form action="settings_script.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </form>

                <hr>

                <h4>Change Password</h4>
                <form action="settings_script.php" method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" name="old-password" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password1" placeholder="Re-type New Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <?php if (isset($_GET['error'])) echo $_GET['error']; ?>
                </form>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>
