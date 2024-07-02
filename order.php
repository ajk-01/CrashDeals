<?php
session_start();
include 'db_connection.php';
// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: MyCart.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the order
    // This is where you would typically save the order to the database
    // and perhaps send a confirmation email to the user

    // For simplicity, we'll just clear the cart and display a confirmation message
    unset($_SESSION['cart']);
    $order_processed = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="order-style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="navbar">
        <div class="left">
            <a href="index.php">Home</a>
            <a href="products.php">Category</a>
            <a href="product.php">Products</a>
            
        </div>
        <div class="right">
           <a href="wishlist.php" style="color: white;"><i class="fa-regular fa-heart"></i></a>
            <a href="MyCart.php" style="color: white;"><i class="fa-solid fa-cart-arrow-down"></a>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<span>Hello, ' . htmlspecialchars($_SESSION['username']) . '</span>';
                echo ' | <a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Hello, Sign In</a>';
                echo ' | <a href="register.php">Register</a>';
            }
            ?>
        </div>
    </div>
    <div class="order-section">
        <h2>Order Confirmation</h2>
        <?php if (isset($order_processed) && $order_processed): ?>
            <p>Thank you for your order! Your order has been processed successfully.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item):
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>$<?php echo number_format($item_total, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>$<?php echo number_format($total_price, 2); ?></td>
                    </tr>
                </tbody>
            </table>
            <form method="post" action="order.php">
                <button type="submit">Confirm Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
