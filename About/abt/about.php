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
    <title>Events Page</title>
    <link rel="stylesheet" href="../../Assets/css/navbar_v2.css">
    <link rel="stylesheet" href="../../Assets/css/events.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar_v2.php'; ?>

    <div class= "construction">
        <div class= "message">
            <h3>Oops! </h3>
            <h4>Under Construction</h4>
            <p>We are currently working on this page. Please check back later.</p>
        </div>

        <div class= "cons">
           <img src="../../Assets/construct.png" alt="Under Construction">
        </div>
    </div>


</body>
</html>