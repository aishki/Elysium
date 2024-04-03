<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

// Retrieve user information from session
$currentEmail = $_SESSION['user_info']['email'];
$access = $_SESSION['user_info']['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../../Assets/css/gen_info.css">
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <p>You have logged in successfully</p>
    <p>Welcome, <?php echo $currentEmail; ?></p>
    <p>Your access level is: <?php echo $access; ?></p>

    
</body>
</html>
