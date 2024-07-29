<?php
require '../includes/common.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!--To add menu option when screen width is reduced-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="index.php">Admin Panel</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href = "products.php"><span class = "glyphicon glyphicon-wrench"></span> Manage Products </a></li>
                    <li><a href = "orders.php"><span class = "glyphicon glyphicon-shopping-cart"></span> Manage Orders</a></li>
                    <li><a href = "clients.php"><span class = "glyphicon glyphicon-user"></span> Manage Clients</a></li>
                    <li><a href = "statistics.php"><span class = "glyphicon glyphicon-stats"></span> Statistics</a></li>
                    <li><a href = "logout_script.php"><span class = "glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</div>