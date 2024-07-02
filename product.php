<?php
session_start();
include "db_connection.php";

// Get product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch product details from the database
$sql = "SELECT * FROM product WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="product-style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $product['name']; ?></h1>
        <p><?php echo $product['description']; ?></p>
        <p class="price">Price: $<?php echo $product['price']; ?></p>
        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
        <a href="index.php">Back to Products</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
