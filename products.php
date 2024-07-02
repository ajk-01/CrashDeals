<?php
 session_start();

 include 'db_connection.php';

 $query = "SELECT * FROM category where parent_id = category_id";
 $result = mysqli_query($conn, $query);
 $category = [];
 if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $category[] = $row;
    }
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Section</title>
    <link rel="stylesheet" href="products-style.css">
</head>
<body>
    <header>
        <div class="nav-bar">
            <span style="margin-left: 10px;"><a href="index.php">Home</a></span>
            <?php if (isset($_SESSION['username'])): ?>
                <span >Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <span><a href="logout.php">Logout</a></span>
            <?php else: ?>
                <span style="margin-left: 94%;"><a href="login.php">Login</a></span>
            <?php endif; ?>
        </div>
    </header>
    <h2>Categories</h2>
    <div class="category-section">
       
        <div class="category-show">
            <?php foreach ($category  as $category): ?>
                <div class="show-inside">
                <h2 style=" font-family: Viner Hand ITC; "><?php echo htmlspecialchars($category['name']);?></h2>
                <img src="<?php echo htmlspecialchars($category['images']);?> " alt="<?php echo htmlspecialchars($category['name']); ?>" >
                <br>
                <a class="" href="product.php" style="text-decoration: none;">see more</a>
                </div>
                        
            <?php endforeach; ?>
            </div>
    </div>
</body>
</html>
