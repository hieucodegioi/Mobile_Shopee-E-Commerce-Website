<!DOCTYPE html>
<html>
<head>
    <title>Search Product by Item ID</title>
</head>
<body>
    <?php
    $product = null;

    if (isset($_GET["item_id"])) {
        $item_id = $_GET["item_id"];
        
        $conn = new mysqli("localhost", "root", "", "shopee");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $selectQuery = "SELECT * FROM product WHERE item_id=$item_id";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Product not found";
        }

        $conn->close();
    }
    ?>

    <h2>Search Product by Item ID</h2>
    <form method="get" action="">
        Item ID: <input type="text" name="item_id">
        <input type="submit" value="Search">
    </form>

    <?php if ($product) : ?>
        <h3>Product Information:</h3>
        <p>Item ID: <?php echo $product["item_id"]; ?></p>
        <p>Brand: <?php echo $product["item_brand"]; ?></p>
        <p>Product Name: <?php echo $product["item_name"]; ?></p>
        <p>Price: <?php echo $product["item_price"]; ?></p>
        <!-- Display the image -->
        <?php if (!empty($product["item_image"])) : ?>
            <img src="<?php echo $product["item_image"]; ?>" alt="Product Image" style="max-width: 300px;">
        <?php else : ?>
            <p>No image available</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>