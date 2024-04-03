<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_info'])) {
    // If logged in, redirect to the home page
    header("Location: ../default/home.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In Page</title>
    <link rel="stylesheet" href="../../Assets/css/log_in.css">
    <link rel="stylesheet" href="../../Assets/css/gen_info.css">
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
</head>

<body class="log-in">
    <?php include '../../navbar/navbar.php'; ?>


    <div class="regis_container">
        <h2>Log-in to your Account</h2>
        <h5>Don't have an account? <a href="../registration/gen_info.php">Sign-up</a></h5>

        <form id="registrationForm" method="POST" action="">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="sample@gmail.com" required>
            </div>
            
            <br>
            <div class="input-group">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="password" placeholder="Password" required>
            </div>

            <?php if (!empty($login_err)) echo '<div class="error-message">' . $login_err . '</div>'; ?>

            <br><br>
            <div class="button-container">
                <input type="submit" value="Log in">
            </div>
        </form>
    </div>
</body>
</html>
