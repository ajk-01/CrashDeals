<?php
session_start();
include 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username=$_SESSION['username'];
$query="SELECT user_id FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user_id=mysqli_fetch_assoc($result);
$_SESSION['user_id']=$user_id;

// Fetch cart items for the logged-in user
$sql = "SELECT * FROM cart_item JOIN cart 
        WHERE cart_item.cart_id = cart.cart_id AND cart.user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="cart-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <div class="left">
            <a href="index.php">Home</a>
            <a href="products.php">Category</a>
            <a href="product.php">Products</a>
            <a href="order.php">Orders</a>
        </div>
        <div class="right">
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

    <div class="container">
        <h2>Cart</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>rrp</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                if (count($cart_items) > 0) {
                    foreach ($cart_items as $item) {
                        if ($item['rrp']==0){
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                        echo '<tr>';
                        echo '<td><img src="images/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '"><br>' . htmlspecialchars($item['name']) . '</td>';
                        echo '<td>$' . number_format($item['price'], 2) . '</td>';
                        echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                        echo '<td>$' . number_format($item_total, 2) . '</td>';
                        echo '<td><a href="remove_from_cart.php?id=' . htmlspecialchars($item['id']) . '">Remove</a></td>';
                        echo '</tr>';}
                        else {
                            $item_total = $item['rrp'] * $item['quantity'];
                            $total_price += $item_total;
                            echo '<tr>';
                            echo '<td><img src="images/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '"><br>' . htmlspecialchars($item['name']) . '</td>';
                            echo '<td>$' . number_format($item['price'], 2) . '</td>';
                            echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                            echo '<td>$' . number_format($item_total, 2) . '</td>';
                            echo '<td><a href="remove_from_cart.php?id=' . htmlspecialchars($item['id']) . '">Remove</a></td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="cart-total">
            <h3>Total: $<?php echo number_format($total_price, 2); ?></h3>
            <a href="order.php" class="btn">Proceed to Order</a>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <!-- <h2 class="logo-text">YourWebsite</h2>
                <p>YourWebsite is a platform to buy and sell various products. Our mission is to provide the best service to our customers.</p>
                <div class="contact">
                    <span><i class="fas fa-phone"></i> &nbsp; +123-456-789</span>
                    <span><i class="fas fa-envelope"></i> &nbsp; info@yourwebsite.com</span>
                </div>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="footer-section links">
                <h2>Quick Links</h2>
                <br>
                <ul>
                    <a href="#"><li>Home</li></a>
                    <a href="#"><li>About</li></a>
                    <a href="#"><li>Services</li></a>
                    <a href="#"><li>Contact</li></a>
                </ul>
            </div>

            <div class="footer-section contact-form">
                <h2>Contact us</h2>
                <br>
                <form action="index.php" method="post">
                    <input type="email" name="email" class="text-input contact-input" placeholder="Your email address...">
                    <textarea name="message" class="text-input contact-input" placeholder="Your message..."></textarea>
                    <button type="submit" class="btn btn-big">
                        <i class="fas fa-envelope"></i>
                        Send
                    </button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> yourwebsite.com | Designed by You
        </div>
    </footer>

    <script src="script.js"></script> -->
</body>
</html>
