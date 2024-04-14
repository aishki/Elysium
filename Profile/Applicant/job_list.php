<?php
// Include the database connection and ProfileModel class
require_once '../ProfileModel.php';

// Check if the user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

// Get the current user's ID from the session
$userID = $_SESSION['user_info']['ID'];
$userType = $_SESSION['user_info']['user_type'];

$profileModel = new ProfileModel();

// Fetch the jobs applied by the current user
$applicationDetails = $profileModel->getApplicationsByUserID($userID, $userType);
?>

<?php
// Check if the applicant has applied for any jobs
if ($applicationDetails->num_rows > 0) {
    // Display the job applications
    while ($row = $applicationDetails->fetch_assoc()) {
        echo '
        <div class="jobContainer">
            <div class= "job_innerdata">
                <div class= "header">
                    <!-- Job Name -->
                    <h4 class= "jobName">' . $row["jobName"] . '</h4>
                    <hr>
                </div>


                <div class= "row">
                    <div class="employer-details">
                        <!-- Name of Employer -->
                        <p class= "data">' . $row["client_fname"] . " " . $row["client_lname"] .'</p>
                        <p class= "label">Employer </p>
                    </div>
                    
                    <div class="mid-data">
                        <!-- Salary -->
                        <p class= "data">₱'. $row["remuneration"] . '</p>
                        <p class= "label">Expected Salary </p>
                        <br>

                        <!-- Application Date -->
                        <p class= "data">' . $row["dateApplied"] . '</p>
                        <p class= "label">Date of Application</p>

                    </div>
                    
                    <div class="t-data">
                        <div class= "statusContainer">
                            <h4 class= "status">' . $row["application_status"] . '</h4>
                            <p class= "label">Status </p>
                        </div>

                        <!-- Deadline -->
                        <p class= "data">' . $row["deadline"] .'</p>
                        <p class= "label">Deadline</p>
                    </div>
                    <!-- when application_status is changed to "Ongoing" show buttons for "Task Complete" -->
                </div>
            </div>
        </div>';
    }
} else {
    // Display a message if the applicant hasn't applied for any jobs yet
    echo '<p>You haven\'t applied for any tasks yet. Go to the <a href="../../Task_Board/TB/taskboard.php">Taskboard</a> and explore opportunities!</p>';
}
?>
