<?php
    include '../Home/config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../Assets/navbar/navbar.css">
    <link rel="stylesheet" href="../Home/css/gen.css">
    <link rel="stylesheet" href="../Admin/accountList.css">
</head>
<body>
    <?php 
        include '../Assets/navbar/navbar.php'; 
    ?>

    <div class="container">
        <h2>Accounts List</h2> 

        <!-- <div class="account_instance">
            <span class="name">fName</span> 
            <span class="name">lName</span>
            <span>accountType</span>
            
        </div> -->
    
        <?php include('get_accounts.php'); ?>


    </div>
</body>