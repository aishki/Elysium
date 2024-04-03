<?php 

require_once '../ProfileModel.php';

$id = $_GET["id"];
$accountType = $_GET["accountType"];

$getAccountData = new ProfileModel();
$accountData = $getAccountData->getAccountData($id, $accountType);


// Sanitize and validate input data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "modify") {
    // Handle form submission securely
    $currentEmail = $_POST['currentEmail'];
    $newEmail = htmlspecialchars($_POST['newEmail']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $currentPassword = htmlspecialchars($_POST['pwd']);

    // Validate input data
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email address
    } else {
        // hash the new password securely before storing it in the database
    }
}



session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}



// // Sanitize and validate input data if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "modify") {
//     // Handle form submission securely
//     $currentEmail = $_POST['currentEmail'];
//     $newEmail = htmlspecialchars($_POST['newEmail']);
//     $newPassword = htmlspecialchars($_POST['newPassword']);
//     $currentPassword = htmlspecialchars($_POST['pwd']);

//     // Validate input data
//     if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
//         // Handle invalid email address
//     } else {
//         // hash the new password securely before storing it in the database
//     }
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin > Selected Profile</title>
    <link rel="stylesheet" href="../../Assets/css/gen_info.css">
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <div class= "main-container">
        <!-- Sidebar -->
        <div class="side-bar">
            <div>You are now signed in as:</div> <br>
                <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['user_info'])) {
                        // Display user_fname and user_lname
                        $user_fname = $_SESSION['user_info']['first_name'];
                        $user_lname = $_SESSION['user_info']['last_name'];

                        // Output the applicant's first name and last name
                        echo "Welcome, $user_fname $user_lname!";

                        // Dump the content of the $_SESSION['user_info'] array
                        // var_dump($_SESSION['user_info']);
                    } else {
                        // Handle if the user is not logged in
                        echo "You are not logged in.";
                    }
                ?>

                <!-- Add logout button -->
                <form action="../log-out.php" method="post">
                    <div class= "button-container">
                        <input type="submit" value="Log Out">
                    </div>
                </form>
        </div>

        <div class="main-tabs">
            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active" data-container="profile-container" id="profile-tab">Accounts</div>
                <div class="tab" data-container="job-list-container" id="job-list-tab">Petitions</div>
                <div class="tab" data-container="reports-container" id="reports-tab">Reports</div>
            </div>

            <!-- Tab Container -->
            <div class="tab-container">
                <div class="tab-header">
                    <a href="profile.php"> 
                        <h3 class="greyed selected tab-heading " data-tab="profile-tab">Account List >  </h3> 
                    </a>
                        <h3 > <?php echo $accountData['first_name'] . ' ' . $accountData['last_name']; ?> </h3>
                </div>
                


                <!-- Content -->
                <div class="content-container">
                    <div class="list-container">
                                        <?php 
                                            if ($accountType == "Applicant"){
                                                include "selectedAcc_Applicant.php";
                                            } else if ($accountType == "Employer"){
                                                include "selectedAcc_Employer.php";
                                            }
                                            
                                        ?>                                
                                    </div> <!-- End profile container -->
                    </div>
                </div>
            </div> <!-- End tab-container -->
        </div> <!-- End main-tabs -->
    </div>
    

    <div class="modify-container">
        <h3>Modify Account</h3>
        <hr>

        <div class="flex">
            <div class="delete-container">
                    <div class="delete-account">
                        <h2>Delete Account</h2>
                        <div class="delete-button">
                            <div class="deleteButtonContainer">
                                <input id="submitButton" type="submit" value="Delete Account">
                            </div>
                        </div>
                    </div>

                    <div class="deletion-reminder">
                        <div class="reminder-content">
                            <span class="important-note">Important Note:</span>
                            <p>Clicking this button initiates a prompt to permanently delete the selected account and associated data. </p>
                        <p> Deleting an account cannot be undone. User data and username will be unrecoverable. This action is irreversible. Please proceed with caution.</p>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../script.js"></script>


            