<?php
// login.php
session_start();
include 'config.php';

 $message = "";

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Handle Login Form
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // 1. Set Session Variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];

            // 2. Set Cookies
            
            // Cookie A: Remember Email (Expires in 30 days)
            setcookie("user_email", $email, time() + (86400 * 30), "/"); 
            
            // Cookie B: Track Last Login Time (Expires in 30 days)
            // Note: This tracks the time of the current successful login
            setcookie("last_login", date("Y-m-d H:i:s"), time() + (86400 * 30), "/");

            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid Password!";
        }
    } else {
        $message = "No user found with this email!";
    }
}

// Pre-fill email from cookie if it exists
 $saved_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background: #f4f4f4; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { color: red; text-align: center; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <div class="message"><?php echo $message; ?></div>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($saved_email); ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="link">Don't have an account? <a href="register.php">Register</a></div>
    </div>
</body>
</html>