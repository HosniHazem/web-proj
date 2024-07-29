<?php
require '../includes/common.php';
require 'includes/admin_header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['product_image'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);

    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    $product_image = basename($_FILES["product_image"]["name"]);

    $product_insert_query = "INSERT INTO items(name, price, image) VALUES ('$product_name', '$product_price', '$product_image')";
    mysqli_query($con, $product_insert_query) or die(mysqli_error($con));
    header('location: products.php');
}

$products_query = "SELECT * FROM items";
$products_result = mysqli_query($con, $products_query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Products</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Products</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" required>
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
        <h3>Product List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($products_result)) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>

                        <td><img src="../img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50"></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
