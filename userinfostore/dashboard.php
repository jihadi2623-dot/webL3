<?php
// dashboard.php
session_start();

// SECURITY CHECK: If session is not set, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Read Last Login from Cookie
 $last_login = isset($_COOKIE['last_login']) ? $_COOKIE['last_login'] : "First time login (Cookie not set yet)";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background: #f4f4f4; }
        .container { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        h2 { color: #333; }
        .info { margin: 20px 0; color: #555; font-size: 18px; }
        .btn-logout { display: inline-block; padding: 10px 20px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
        .btn-logout:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
        
        <div class="info">
            <p><strong>Last Login:</strong> <?php echo htmlspecialchars($last_login); ?></p>
        </div>

        <p>You have successfully accessed the protected dashboard.</p>
        <br>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>