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
    <link rel="stylesheet" href="../../Assets/css/navbar_v2.css">
    <link rel="stylesheet" href="../../Assets/css/dashb.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar_v2.php'; ?>

    <div class="container">
  <div class="item item1">
    <p>Header</p>
  </div>
  <div class="item item2">
    <p>Sidebar</p>
  </div>
  <div class="item item3">
    <p>Content</p>
  </div>
  <div class="item item4">
    <p>Footer</p>
  </div>
</div>

</body>

</html>