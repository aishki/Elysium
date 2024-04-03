<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Include ProfileModel.php
include_once 'ProfileModel.php';

// Check if the user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "modify") {
    // Get current session user's information
    $userInfo = $_SESSION['user_info'];
    $currentPassword = $userInfo['password']; // Current password from session
    
    // Get form inputs
    $newEmail = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $currentInputPassword = $_POST['currentPassword'];

    // Validate current password
    if ($currentInputPassword != $currentPassword) {
        echo "Password is incorrect";
        exit();
    }

    // Create an instance of ProfileModel
    $profileModel = new ProfileModel();

    // Check if the user wants to change email
    if (!empty($newEmail) && $newEmail != $userInfo['email']) {
        // Check if the new email is unique across all tables
        if ($profileModel->isEmailUnique($newEmail)) {
            // Update user's email
            $profileModel->updateEmail($userInfo['ID'], $newEmail);
            echo "Your email has been updated successfully <br>";
        } else {
            echo "Email is already in use";
        }
    }

    // Check if the user wants to change password
    if (!empty($newPassword)) {
        // Check if new password matches the confirmed password
        if ($newPassword != $confirmPassword) {
            echo "Passwords do not match";
            exit();
        }
        // Update user's password
        $profileModel->updatePassword($userInfo['ID'], $newPassword);
        echo "Your password has been updated successfully";
    }
}

// Check if the form is submitted and the delete request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitDeletionRequest'])) {
    // Get the current user's ID and role from session
    $userID = $_SESSION['user_info']['ID'];
    $userRole = $_SESSION['user_info']['user_type'];

    // Create an instance of ProfileModel
    $profileModel = new ProfileModel();

    // Check if user already submitted deletion request
    $existingRequest = $profileModel->checkExistingDeletionRequest($userID, $userRole);

    if ($existingRequest) {
        // Prompt the user that they have already submitted a request
        echo "You have already submitted a deletion request prior. Please be patient as the admin monitors your request.";
        
    } else {
        // Determine the appropriate ID based on the user's role
        if ($userRole === 'Applicant') {
            // If the user is an applicant, use the applicant ID
            $applicantID = $userID;
            $employerID = null;
        } else {
            // If the user is an employer, use the employer ID
            $employerID = $userID;
            $applicantID = null;
        }

        echo "Your request has been submitted successfully. Kindly wait for the admin to confirm your account deletion.";
        // Submit deletion request with the appropriate ID
        $response = $profileModel->submitDeletionRequest($applicantID, $employerID);
        echo $response;
    }
    exit();
}


// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDeletion'])) {




// }


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "confirmDelete") {
    $userID = $_POST['id']; 
    $userRole = $_POST['accountType'];
    $reqID = $_POST['reqID'];

    $profileModel = new ProfileModel();

    // Ensure userID and userRole are set and not empty
    if (isset($_POST['userID']) && isset($_POST['userRole']) && !empty($_POST['userID']) && !empty($_POST['userRole'])) {
        
        var_dump($userID);
        var_dump($userRole);
        echo 'Error deleting account, data not found';

    } else {
        $success = $profileModel->deleteAccount($userID, $userRole, $reqID);
        if ($success) {
            echo 'Account Deleted successfully';
            header("Location: Admin/profile.php");
    } else  {
        echo "Error deleting account";
    }

    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "cancelPetition") {
    $userID = $_POST['id'];
    $userRole = $_POST['accountType'];
    $reqID = $_POST['reqID'];

    $profileModel = new ProfileModel();


    // Ensure userID and userRole are set and not empty
    if (isset($_POST['userID']) && isset($_POST['userRole']) && !empty($_POST['userID']) && !empty($_POST['userRole'])) {
        var_dump($userID);
        var_dump($userRole);
        echo 'Error cancelling petition';
       
    } else {
        $success = $profileModel->cancelPetition($userID, $userRole);
        if ($success) {
            echo 'Petition is cancelled successfully';
            header("Location: Admin/profile.php");
        }   

    }
}

    exit();
}

