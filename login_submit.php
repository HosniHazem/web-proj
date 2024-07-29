<?php
require 'includes/common.php';

if (isset($_SESSION['email'])) {
    header('location: products.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password = md5($password);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: login.php?error=Invalid email format');
        exit();
    }

    if (strlen($password) < 6) {
        header('location: login.php?error=Password must be at least 6 characters long');
        exit();
    }

    $user_authentication_query = "SELECT id, email, role FROM users WHERE email='$email' AND password='$password'";
    $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
    $rows_fetched = mysqli_num_rows($user_authentication_result);

    if ($rows_fetched == 0) {
        header('location: login.php?error=Invalid login details');
        exit();
    } else {
        $row = mysqli_fetch_array($user_authentication_result);
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role']; 

        if ($row['role'] == 'admin') {
            header('location: admin/products.php');
        } else {
            header('location: products.php');
        }
        exit();
    }
}
?>
