<?php
require '../includes/common.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: ../index.php');
}

$client_id = $_GET['id'];
$client_query = "SELECT * FROM users WHERE id='$client_id'";
$client_result = mysqli_query($con, $client_query) or die(mysqli_error($con));
$client = mysqli_fetch_assoc($client_result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $update_query = "UPDATE users SET name='$name', email='$email', contact='$contact', city='$city', address='$address' WHERE id='$client_id'";
    mysqli_query($con, $update_query) or die(mysqli_error($con));
    header('location: clients.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Client</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Client</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $client['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $client['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $client['contact']; ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $client['city']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $client['address']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Client</button>
        </form>
    </div>
</body>
</html>
