
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrashDeals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-logo border">
                <div class="logo">
                    <a href="#" ><h1>CrashDeals</h1></a>
                </div>
            </div>
            <div class="nav-search border">
                <select class="search-select border">
                    <option>All</option>
                    <option>Gadgets</option>
                    <option>Bodycare</option>
                    <option>FoodItems</option>
                    <option>Furniture</option>
                </select>
                <input class="search-input" placeholder="Search CrashDeals">
                <button class="search-icon border">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="returns-order border">
                 <p><span>Returns</span></p>     
                <a href="order.php"> <p class="order" style="display: block;"> & Orders</a>

            </div>
            <div class="nav-wishlist">
            <a href="wishlist.php" style="color: white;"><i class="fa-regular fa-heart"></i></a>
            </div>
            <div class="nav-cart border">
               <a href="MyCart.php"><i class="fa-solid fa-cart-arrow-down"></i></a>
            </div>
            <div class="sign-in border">
                <i  class="fa-solid fa-user" style="font-size: 20px;"></i>
                <?php 
                session_start();
                include "db_connection.php";
                if (isset($_SESSION['username'])): ?>
                
               <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
               <br><a href="logout.php">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></span>
               
               <?php else: ?>
                 <span>Hello,<a  href="login.php">Sign In</a></span>
              <?php endif; ?>
            </div>
            
           </div>
        <div class="panel ">
              <a href="products.php">Categories</a>
              <a href="product.php">Products</a>
              <a href="#">Today's Deals</a>
              <a href="#"> Service</a>
              <a href="#"> Registry</a>
              <a href="#">Gift Cards</a>
              <a href="#" >Sell</a>
        </div>
    </header>
    <main >
        <div class="hero-section">
            <div class="hero-text">
               <p>Living Life The Way We Want</p>
           </div>
           </div>
          <div style="background-color: #f8ada7;"> 
        <div class="category-section">
            <div class=" category">
                <h2 style=" font-family: Viner Hand ITC;">Furniture</h2>
                <div class="box-img" style=" background-image: url('images/categories/furniture/Furniture.jpg');
                background-size: cover;"></div>
                <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class=" category">
                <h2 style=" font-family: Viner Hand ITC;">Food</h2>
               <div class="box-img" style="background-image: url('images/categories/food/hero.jpg');
                   background-size: cover;"></div>
                   <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class="category">
                <h2 style=" font-family: Viner Hand ITC;">Electronics</h2>
             <div class="box-img" style=" background-image: url(images/categories/gadgets/Laptops.jpg);
                   background-size: cover;"></div>
                   <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class=" category">
                <h2 style=" font-family: Viner Hand ITC;">Bodycare</h2>
            <div class="box-img" style="background-image: url(images/categories/hero-body.jpg);
             background-size: cover;"></div>
             <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
        
      
           <div class="category">
                <h2 style=" font-family: Viner Hand ITC;">Tables</h2>
                <div class="box-img" style=" background-image: url('images/categories/furniture/table.jpg');
                background-size: cover;"></div>
                <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class="category">
                <h2 style=" font-family: Viner Hand ITC;">Snacks</h2>
               <div class="box-img" style="background-image: url('images/categories/food/pringles.jpg');
                   background-size: cover;"></div>
                   <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class="category">
                <h2 style=" font-family: Viner Hand ITC;">Chairs</h2>
             <div class="box-img" style=" background-image: url(images/categories/furniture/mordern_chair.jpg);
                   background-size: cover;"></div>
                   <a href="product.php" style="text-decoration: none;">see more</a>
            </div>
            <div class="category">
                <h2 style=" font-family: Viner Hand ITC;">Lotions</h2>
            <div class="box-img" style="background-image: url(images/categories/bodycare/lotion.jpg);
             background-size:cover;"></div>
             <a href="product.php?id=<?php echo $row['product_id']; ?>" style="text-decoration: none;">see more</a>
            </div>
         </div>
         </div>
        

 </main>
    <footer>
          
        <div class="footer1">
            <a  href="index.php">Back to top</a>
        </div>
        <div class="footer-2" >
          <span>Copyright &copy; <?php echo date("Y"); ?> Crashdeals</span>
      </div>
    
    </footer>
</body>
</html>



