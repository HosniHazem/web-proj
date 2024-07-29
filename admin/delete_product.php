<?php
require '../includes/common.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: ../index.php');
}

$product_id = $_GET['id'];
$delete_query = "DELETE FROM items WHERE id='$product_id'";
mysqli_query($con, $delete_query) or die(mysqli_error($con));
header('location: products.php');
?>
