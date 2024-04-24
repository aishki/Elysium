<?php

// Include the database connection and ProfileModel class
require_once '../p_model/ProfileModel.php';

// Check if the job ID is provided via POST method
if (isset($_POST['job_ID'])) {
    // Get the job ID
    $job_ID = $_POST['job_ID'];

    // Create an instance of ProfileModel
    $profileModel = new ProfileModel();

    // Call the getJobDetailsById function to fetch job details
    $job_details = $profileModel->getJobDetailsById($job_ID);

    // Check if job details are found
    if ($job_details) {
        // Send JSON response with job details
        header('Content-Type: application/json');
        echo json_encode($job_details);
    } else {
        // Send JSON response with error message
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'No job details found for the provided job ID.'));
    }
}
?>