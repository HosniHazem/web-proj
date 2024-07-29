<?php
// Establish the connection to the database
require("includes/common.php");

// Fetch items from the database
$query = "SELECT * FROM items";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Stop-Style Store</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .thumbnail {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }
        .thumbnail img {
            width: 100%;
            height: auto;
        }
        .caption {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .caption h3, .caption p {
            margin: 0;
        }
        .caption .btn {
            margin-top: auto;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Calculate the maximum height of the product thumbnails
            let maxHeight = 0;

            $('.thumbnail').each(function() {
                let thisHeight = $(this).outerHeight();
                if (thisHeight > maxHeight) {
                    maxHeight = thisHeight;
                }
            });

            // Apply the maximum height to all product thumbnails
            $('.thumbnail').height(maxHeight);
        });
    </script>
</head>
<body>
    <?php
    include 'includes/header.php';
    include 'includes/check-if-added.php';
    ?>
    <div class="container" id="content">
        <div class="row text-center">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $image = $row['image'];
            ?>
                <div class="col-md-4 col-sm-6 home-feature">
                    <div class="thumbnail">
                        <img src="<?php echo "./img/".$image; ?>" alt="<?php echo $name; ?>">
                        <div class="caption">
                            <h3><?php echo $name; ?></h3>
                            <p>Price: Rs. <?php echo number_format($price, 2); ?></p>
                            <?php if (!isset($_SESSION['email'])) { ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php
                            } else {
                                if (check_if_added_to_cart($id)) {
                                    echo '<a href="#" class="btn btn-block btn-success" disabled>Added to cart</a>';
                                } else {
                                    ?>
                                    <a href="cart-add.php?id=<?php echo $id; ?>" name="add" value="add" class="btn btn-block btn-primary">Add to cart</a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    
    <?php include("includes/footer.php"); ?>
</body>
</html>
