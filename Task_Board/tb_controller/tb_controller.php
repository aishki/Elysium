<?php
session_start();
include '../tb_model/tb_Model.php';


// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../../Home/log-in/log-in.php");
    exit();
}

// Check if the form is submitted and action is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Switch based on the action
    switch ($action) {
        case "create":
            handleCreateTask($conn);
            break;
        case "apply":
            handleApplyForJob($conn);
            break;
        default:
            // Invalid action, redirect to the task board page
            redirectToTaskboard();
            break;
    }
} else {
    // Invalid request, redirect to the task board page
    redirectToTaskboard();
}

// Function to handle creating a new task
function handleCreateTask($conn) {
    // Implementation of create task function
    // Validate form data
    $errors = array();

    // Check if all required fields are filled
    if (!isset($_POST['jobName']) || empty($_POST['jobName']) || !isset($_POST['rank']) || empty($_POST['rank']) || !isset($_POST['jobDescription']) || empty($_POST['jobDescription']) || !isset($_POST['salary']) || empty($_POST['salary']) || !isset($_POST['deadline']) || empty($_POST['deadline'])) {
        $errors[] = "All fields are required.";
    } else {
        // Sanitize input data
        $jobName = htmlspecialchars($_POST['jobName']);
        $rank = htmlspecialchars($_POST['rank']);
        $jobDescription = htmlspecialchars($_POST['jobDescription']);
        $salary = floatval($_POST['salary']);
        $deadline = $_POST['deadline'];

        // Get client from session
        $clientID = $_SESSION['user_info']['ID'];

        // Insert task into the database
        require_once '../tb_model/tb_Model.php';
        $jobModel = new JobModel($conn);

        // Execute the addTask method
        if ($jobModel->addTask($clientID, $jobName, $rank, $jobDescription, $salary, $deadline)) {
            // Task added successfully
            header("Location: ../tb/taskboard.php");
            exit();
        } else {
            // Error adding task
            $errors[] = "Error adding task. Please try again.";
        }
    }

    // If there are errors, redirect back to the task board page with error messages
    header("Location: ../tb/taskboard.php?errors=" . urlencode(serialize($errors)));
    exit();
}

// Function to handle applying for a job
function handleApplyForJob($conn) {
    // Validate user rank
    $userID = $_SESSION['user_info']['ID'];
    $userRank = $_SESSION['user_info']['userLevel'];

    // Get job ID from form
    $jobID = $_POST['jobID'];

    // Check if the user has already applied for the same job
    $sql = "SELECT * FROM applications_list WHERE job_ID = ? AND applicant_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $jobID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User has already applied for this job
        $message = "You have already applied for this job. Kindly wait for the employer to contact you or updates on your Job listings profile";
        header("Location: ../tb/taskboard.php?error=" . urlencode($message));
        exit();
    }

    // Fetch job information from the database
    require_once '../tb_model/tb_Model.php';
    $jobModel = new JobModel($conn);
    $jobInfo = $jobModel->getJobInfo($jobID);

    // Check if user's rank meets the job requirements
    if ($userRank >= $jobInfo['job_rank']) {
        // Insert application into applications_list table
        $dateApplied = date("Y-m-d");
        $applicationStatus = "Pending";

        $sql = "INSERT INTO applications_list (job_ID, applicant_ID, dateApplied, application_status)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $jobID, $userID, $dateApplied, $applicationStatus);
        $stmt->execute();
        $stmt->close();

        // Update job status to "Pending" in the job table
        $sql = "UPDATE job SET job_status = 'Pending' WHERE job_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $jobID);
        $stmt->execute();
        $stmt->close();

        // Redirect back to the task board page with success message
        header("Location: ../tb/taskboard.php?success=1");
        exit();
    } else {
        // User's rank does not meet job requirements
        $message = "You do not meet the rank requirements for this job. Submit a petition to increase your rank.";
        header("Location: ../tb/taskboard.php?error=" . urlencode($message));
        exit();
    }
}

// Function to redirect to the task board page
function redirectToTaskboard() {
    header("Location: ../tb/taskboard.php");
    exit();
}
?>
