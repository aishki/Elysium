<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../../Assets/css/gen.css">
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/profile.css">
    <link rel="stylesheet" href="../../Assets/css/job_list.css">
    <link rel="stylesheet" href="../../Assets/css/admin_list-boxes.css">

    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <div class= "main-container">
        <!-- Sidebar -->
        <div class="side-bar">

            <div class= "side-wlc">You are now signed in as: <br>
                <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['user_info'])) {
                        // Display user_fname and user_lname
                        $user_fname = $_SESSION['user_info']['first_name'];
                        $user_lname = $_SESSION['user_info']['last_name'];

                        // Output the applicant's first name and last name
                        echo "Welcome, $user_fname $user_lname!";
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

                <!-- Content -->
                <div class="js-container">

                    <div class="profile-container">
                        <h3>Account List</h3>

                        <div class="hd-container">
                            <?php include 'accounts_list.php'; ?>
                        </div>


                       
                    </div> <!-- End profile container -->

                    <div class="job-list-container" style="display: none;">
                        <h3>Pending Petitions</h3>

                        <div class="hd-container">
                            <?php include 'petitions_list.php'; ?>
                        </div>
                    </div> <!-- End jobs container -->

                    <div class="reports-container" style="display: none;">
                        <h3>Reports</h3>

                        <div class="hd-container">
                            <?php include 'reports.php'; ?>
                        </div>
                    </div> <!-- End reports container -->
                    
                </div> <!-- End js container -->
            </div> <!-- End tab-container -->
        </div> <!-- End main-tabs -->
    </div>

    <div class="modify-container">
        <h3>Modify Account</h3>
        <hr>

        <div class="flex">
            <div class="modification">
                <h2>Log In Details</h2>

                <div class="container">
                    <div class="current-container">
                        <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['user_info'])) {

                                // Display user_fname and user_lname
                                $currentemail= $_SESSION['user_info']['email'];
                                $currentpassword= $_SESSION['user_info']['password'];

                                // Output the applicant's first name and last name
                                echo "Current Email: $currentemail <br>";
                                echo "Current Password: $currentpassword";


                            } else {
                                // Handle if the user is not logged in
                                echo "You are not logged in.";
                            }
                        ?>
                    </div>

                    <div class="change-input">
                        
                        <form id="modifyUser" method="POST" action="../ProfileController.php">
                        
                            <div class="row">
                                <div class="input-group">
                                    <label for="email">New Email</label>
                                    <input type="email" name="email" id="email" placeholder="newemail@gmail.com">
                                </div>
                            </div>    

                            <div class="row">
                                <div class="input-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" name="newPassword" id="newPassword" placeholder="New Password" oninput="checkPasswordMatch()">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" oninput="checkPasswordMatch()">
                                    <div id="passwordError" class="error-message">Passwords do not match</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group">
                                <br> 
                                    <label for="currentPwd">Current Password</label>
                                    <input type="password" name="currentPassword" id="currentPassword" placeholder="Current Password" required>
                                </div>
                            </div>


                            <div class="button-container">
                                <input type="hidden" name="action" value="modify">
                                <input type="submit" value="Modify">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="delete-container">
                <div class="delete-account">
                    <h2>Delete Account</h2>
                    <form id="deleteForm">
                        <?php #var_dump($_SESSION)?>
                        <div class="delete-button">
                            <div class="deleteButtonContainer">
                                <input id="deleteButton" type="submit" value="Submit Deletion Request">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="deletion-reminder">
                    <div class="reminder-content">
                        <span class="important-note">Important Note:</span>
                        <p>Clicking this button initiates a request to permanently delete your account and associated data. </p>
                        <p>An administrator will review and confirm the deletion before it's complete. This action is irreversible. Please proceed with caution.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script src="../script.js"></script>

</body>
</html>