<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

// Retrieve user information from session
$currentName = $_SESSION['user_info']['first_name'];
$access = $_SESSION['user_info']['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../../Assets/css/gen.css">
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/home.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <div class = "part">
            <p>Welcome, <?php echo $currentName; ?> to</p>
            <h1>Elysium</h1>

            <p>Your access level is: <?php echo $access; ?></p>
    </div>
    
    <div class = "part">
            <p>Welcome, <?php echo $currentName; ?> to</p>
            <h1>Elysium</h1>

            <p>Your access level is: <?php echo $access; ?></p>
    </div>
</body>
</html>
