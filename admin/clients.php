<?php
require '../includes/common.php';
require 'includes/admin_header.php';

$clients_query = "SELECT * FROM users WHERE role='user'";
$clients_result = mysqli_query($con, $clients_query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Clients</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Clients</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($client = mysqli_fetch_assoc($clients_result)) { ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['contact']; ?></td>
                        <td><?php echo $client['city']; ?></td>
                        <td><?php echo $client['address']; ?></td>
                        <td>
                            <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
