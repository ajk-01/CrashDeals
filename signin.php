 <?php
 session_start();
   include 'db_connection.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phn_no=$_POST['phn_no'];
    $password = $_POST['password'];

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'OR phn_no='$phn_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username or email already exists, redirect back to registration page with error message
        $_SESSION['register_error'] = "Username or email or phone number already exists.";
        header("Location: login.php");
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (username, email,phn_no, password_hash) VALUES ('$username', '$email', $phn_no,'$password')";
        if ($conn->query($sql) === TRUE) {
            // Registration successful, set session variable and redirect to dashboard
            $_SESSION['username'] = $username;

            header("Location: index.php");
        } else {
            // Error inserting new user, redirect back to registration page with error message
            $_SESSION['register_error'] = "Error registering user.";
            header("Location: index.php");
        }
    }

?> 



