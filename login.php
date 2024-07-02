<?php
 session_start();
 include "db_connection.php";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    // $email=$_POST['email'];
    // $phn_no=$_POST['phn_no'];
    $password = $_POST['password'];
    // Validate input (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo "Please enter both username and password.";
    } else {
        // SQL query to check if username and password match
        $sql = "SELECT * FROM users WHERE username='$username'  AND  password_hash='$password' ";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $_SESSION['login-error']=" user doesn't exists";
            header("Location:signin.html");
        }
        elseif($result->num_rows>0) {
            // Login successful
                $_SESSION['username'] = $username;
                header("Location: index.php");
             
        }
         else {
            // Login failed
            echo "Invalid username or password.";
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="reg-style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <h2>Login</h2>
    <form action="login.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
                <span>not register?<a href="signin.html">Register</a></span>
				<input type="submit" value="Login">
			</form>
            </div>      
    <?php
    if (isset($_SESSION['login_error'])) {
        echo '<p style="color:red;">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
        unset($_SESSION['login_error']);
    }
    ?>
</body>
</html>
