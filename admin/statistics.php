<?php
require '../includes/common.php';
require 'includes/admin_header.php';

$total_sales_query = "SELECT SUM(items.price) AS total_sales FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.status = 'Confirmed'";
$total_sales_result = mysqli_query($con, $total_sales_query) or die(mysqli_error($con));
$total_sales = mysqli_fetch_assoc($total_sales_result)['total_sales'];

$total_orders_query = "SELECT COUNT(*) AS total_orders FROM user_item";
$total_orders_result = mysqli_query($con, $total_orders_query) or die(mysqli_error($con));
$total_orders = mysqli_fetch_assoc($total_orders_result)['total_orders'];

$total_clients_query = "SELECT COUNT(*) AS total_clients FROM users WHERE role = 'user'";
$total_clients_result = mysqli_query($con, $total_clients_query) or die(mysqli_error($con));
$total_clients = mysqli_fetch_assoc($total_clients_result)['total_clients'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Statistics</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Statistics</h2>
        <table class="table table-bordered">
            <tr>
                <th>Total Sales</th>
                <td><?php echo $total_sales; ?></td>
            </tr>
            <tr>
                <th>Total Orders</th>
                <td><?php echo $total_orders; ?></td>
            </tr>
            <tr>
                <th>Total Clients</th>
                <td><?php echo $total_clients; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
