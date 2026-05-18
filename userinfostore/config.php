<?php
// config.php

 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "user_auth_db";

// ADD THIS LINE: Set the port you saw in XAMPP (3306 or 3307)
 $port = 4306; 

// UPDATE THIS LINE: Add the $port variable at the end
 $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>