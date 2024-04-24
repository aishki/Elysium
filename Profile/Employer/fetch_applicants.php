<?php
// Include the database connection and ProfileModel class
require_once '../p_model/ProfileModel.php';

// Check if the job ID is provided
if (isset($_POST['job_ID'])) {
    // Get the job ID
    $jobId = $_POST['job_ID'];

    // Create an instance of ProfileModel
    $profileModel = new ProfileModel();

    // Fetch applicants for the given job ID
    $applicants = $profileModel->getApplicantsByJobId($jobId);

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($applicants);
}
?>
