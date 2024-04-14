<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_info'])) {
    // If logged in, redirect to the home page
    header("Location: Home/default/home.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="Assets/css/gen.css">
    <link rel="stylesheet" href="Assets/css/navbar.css">
</head>

<body class="default">
    <nav class="navbar">
        <div class="logo">
            <img src="Assets/logo.png" alt="Logo">  
        </div>
        <div class="nav-links">
            <a href="#" class="nav-item">Home</a>
            <a href="#" class="nav-item">About</a>
            <a href="#" class="nav-item">Task Board</a>
            <a href="Home/log-in/log-in.php" class="nav-item login">Log-in</a>
        </div>
    </nav>
</body>
</html>