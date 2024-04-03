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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registration Page</title>
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/gen_info.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <div class="regis_container">
        <h2>Register New Account</h2>
        <h5>Already have an account? <a href="../log-in/log-in.php">Log In</a></h5>

        <form id="registrationForm" method="POST" action="../processes/process-info.php" onsubmit="return validateForm()">
            <div class="access-options">
                <button type="button" class="access-option buy-services"     id="buyServicesBtn"     onclick="setAccess('Employer')">I want to buy services</button>
                <button type="button" class="access-option provide-services" id="provideServicesBtn" onclick="setAccess('Applicant')">I want to provide services</button>
                <!-- Hidden input field to store the selected option -->
                <input type="hidden" id="access" name="access" value="">
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="firstName">First Name</label>
                    <input autocomplete="given-name" type="text" name="fname" id="firstName" placeholder="First Name" required>
                </div>

                <div class="input-group">
                    <label for="lastName">Last Name</label>
                    <input autocomplete="family-name" type="text" name="lname" id="lastName" placeholder="Last Name" required>
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input autocomplete="email" type="email" name="email" id="email" placeholder="sample@gmail.com" required>
                    <div id="emailError" class="error-message" style="display: none;">Email is already registered.</div>
                </div>

                <div class="input-group">
                    <label for="contactNumber">Contact Number</label>
                    <input autocomplete="tel" type="tel" name="contactNumber" id="contactNumber" placeholder="Contact Number" required>
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="pwd" id="password" placeholder="Password" required oninput="validateForm()">
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required oninput="validateForm()">
                    <div id="passwordError" class="error-message">Passwords do not match</div>
                </div>
            </div>
            
            <br>

            <div class="hide" id="hide_container">
                <hr>
                <br><br>

                <div class="reminder" id="reminder">
                    <i>Reminder</i>: You have chosen to create an <b id="accountType">Account Type</b>
                </div>

                <div class="reminder-subtext">
                    We urge you to carefully confirm your desired account type. <br>
                    Changes will not be possible after creation.
                </div>

                <br><br>
                <hr>

                <div id="employerSection" style="display: none;"> <!-- Initially hide the employer section -->
                    <?php include 'employer.php'; ?> <!-- Include the content of employer.php -->
                </div>

                <div id="applicantSection" style="display: none;"> <!-- Initially hide the applicant section -->
                    <?php include 'applicant.php'; ?> <!-- Include the content of applicant.php -->
                </div>


                <div class="button-container">
                    <input id="submitButton" type="submit" value="Submit">
                </div>
            </div>
        </form>

    </div>

    <script src="script.js"></script>

</body>
</html>