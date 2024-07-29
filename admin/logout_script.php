<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: /eCommerce-website/login.php');
}
session_destroy();
header('Location: /eCommerce-website/index.php');
exit();
?>