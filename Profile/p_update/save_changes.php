<?php
session_start();

// Include database connection and model
include '../../db_connection.php';
include '../../Home/r_model/r_model.php';

// Retrieve POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $suffix = $_POST['sufx'];

    // Check if the user ID is set in the session
    if (isset($_SESSION['user_info']['ID'])) {
        // Extract user ID from session
        $userID = $_SESSION['user_info']['ID'];

        // Create DatabaseModel instance
        $databaseModel = new DatabaseModel($conn);

        // Update user data
        $userType = $_SESSION['user_info']['user_type'];
        $databaseModel->updateUserData($firstName, $lastName, $suffix, $userID, $userType);

        // Respond with success
        http_response_code(200);
        echo json_encode(array("message" => "Data updated successfully"));
    } else {
        // Respond with error if user ID is not found in session
        http_response_code(400);
        echo json_encode(array("message" => "User ID not found in session"));
    }
} else {
    // Respond with error if it's not a POST request
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
