<?php
require '../includes/common.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: ../index.php');
}

$order_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_status = mysqli_real_escape_string($con, $_POST['order_status']);
    $update_query = "UPDATE user_item SET status='$order_status' WHERE id='$order_id'";
    mysqli_query($con, $update_query) or die(mysqli_error($con));
    header('location: orders.php');
}

$order_query = "SELECT status FROM user_item WHERE id='$order_id'";
$order_result = mysqli_query($con, $order_query) or die(mysqli_error($con));
$order = mysqli_fetch_assoc($order_result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order Status</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Update Order Status</h2>
        <form method="POST">
            <div class="form-group">
                <label for="order_status">Order Status</label>
                <select class="form-control" id="order_status" name="order_status" required>
                    <option value="Added to cart" <?php if ($order['status'] == 'Added to cart') echo 'selected'; ?>>Added to cart</option>
                    <option value="Confirmed" <?php if ($order['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
</body>
</html>
