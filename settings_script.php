<?php
require("common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user details
    if (isset($_POST['name']) && isset($_POST['contact']) && isset($_POST['city']) && isset($_POST['address'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $address = mysqli_real_escape_string($con, $_POST['address']);

        $query = "UPDATE users SET name = '$name', contact = '$contact', city = '$city', address = '$address' WHERE email = '" . $_SESSION['email'] . "'";
        mysqli_query($con, $query) or die(mysqli_error($con));

        header('location: settings.php?error=Details updated successfully');
        exit();
    }

    // Change password
    if (isset($_POST['old-password']) && isset($_POST['password']) && isset($_POST['password1'])) {
        $old_pass = mysqli_real_escape_string($con, $_POST['old-password']);
        $old_pass = MD5($old_pass);

        $new_pass = mysqli_real_escape_string($con, $_POST['password']);
        $new_pass = MD5($new_pass);

        $new_pass1 = mysqli_real_escape_string($con, $_POST['password1']);
        $new_pass1 = MD5($new_pass1);

        $query = "SELECT password FROM users WHERE email = '" . $_SESSION['email'] . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $orig_pass = $row['password'];

        if ($new_pass != $new_pass1) {
            $error = "<span class='red'>The two passwords don't match</span>";
            header('location: settings.php?error=' . urlencode($error));
            exit();
        } else {
            if ($old_pass == $orig_pass) {
                $query = "UPDATE users SET password = '" . $new_pass . "' WHERE email = '" . $_SESSION['email'] . "'";
                mysqli_query($con, $query) or die(mysqli_error($con));
                $error = "<span class='red'>Password Updated</span>";
                header('location: settings.php?error=' . urlencode($error));
                exit();
            } else {
                $error = "<span class='red'>Wrong Old Password</span>";
                header('location: settings.php?error=' . urlencode($error));
                exit();
            }
        }
    }
}
?>
