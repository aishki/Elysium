<?php
// Include the database connection and ProfileModel class
require_once '../ProfileModel.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data is provided
    if (isset($_POST['applicationID']) && isset($_POST['status'])) {
        // Retrieve the application ID and status from the POST data
        $applicationID = $_POST['applicationID'];
        $status = $_POST['status'];

        // Create an instance of ProfileModel
        $profileModel = new ProfileModel();

        // Update the application status
        $result = $profileModel->updateApplicationStatus($applicationID, $status);

        if ($result) {
            // Status updated successfully
            echo json_encode(array("success" => true));
        } else {
            // Failed to update status
            echo json_encode(array("success" => false, "message" => "Failed to update status"));
        }
    } else {
        // Required data not provided
        echo json_encode(array("success" => false, "message" => "Missing parameters"));
    }
} else {
    // Request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
