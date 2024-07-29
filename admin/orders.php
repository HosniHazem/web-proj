<?php
require '../includes/common.php';
require 'includes/admin_header.php';

$orders_query = "SELECT user_item.id, users.name AS user_name, items.name AS item_name, user_item.status, user_item.date_time FROM user_item JOIN users ON user_item.user_id = users.id JOIN items ON user_item.item_id = items.id";
$orders_result = mysqli_query($con, $orders_query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Orders</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Date/Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($orders_result)) { ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['item_name']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['date_time']; ?></td>
                        <td>
                            <a href="update_order.php?id=<?php echo $order['id']; ?>" class="btn btn-warning">Update Status</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
