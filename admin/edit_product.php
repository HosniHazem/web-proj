<?php
require '../includes/common.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: ../index.php');
}

$product_id = $_GET['id'];
$product_query = "SELECT * FROM items WHERE id='$product_id'";
$product_result = mysqli_query($con, $product_query) or die(mysqli_error($con));
$product = mysqli_fetch_assoc($product_result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);

    if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
        $product_image = basename($_FILES["product_image"]["name"]);

        $update_query = "UPDATE items SET name='$product_name', price='$product_price', image='$product_image' WHERE id='$product_id'";
    } else {
        $update_query = "UPDATE items SET name='$product_name', price='$product_price' WHERE id='$product_id'";
    }

    mysqli_query($con, $update_query) or die(mysqli_error($con));
    header('location: products.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
