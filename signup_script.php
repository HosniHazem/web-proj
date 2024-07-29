<?php
require 'includes/common.php';

if (isset($_SESSION['email'])) {
    header('location: products.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $password = md5($password);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: signup.php?m1=Invalid email format');
        exit();
    }

    // Validate contact number
    if (!preg_match("/^[0-9]{10}$/", $contact)) {
        header('location: signup.php?m2=Invalid contact number');
        exit();
    }

    // Check for duplicate email
    $duplicate_user_query = "SELECT id FROM users WHERE email='$email'";
    $duplicate_user_result = mysqli_query($con, $duplicate_user_query) or die(mysqli_error($con));
    $rows_fetched = mysqli_num_rows($duplicate_user_result);

    if ($rows_fetched > 0) {
        header('location: signup.php?m1=Email already exists');
        exit();
    } else {
        $user_registration_query = "INSERT INTO users(name, email, password, contact, city, address) VALUES ('$name', '$email', '$password', '$contact', '$city', '$address')";
        $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = mysqli_insert_id($con);
        header('location: products.php');
        exit();
    }
}
?>
