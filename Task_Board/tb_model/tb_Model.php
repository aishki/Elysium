<?php
include '../../db_connection.php';

class JobModel {
    private $conn;

    // Constructor that accepts the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add a new task
    public function addTask($clientID, $jobName, $rank, $jobDescription, $salary, $deadline) {
        // Convert the deadline to MySQL date format
        $deadline = date("Y-m-d", strtotime($deadline));
        
        // Prepare and execute the SQL query to insert the task into the database
        $sql = "INSERT INTO job (client_ID, jobName, job_rank, jobDescription, remuneration, dateAdded, deadline, job_status, dateCompleted)
                VALUES (?, ?, ?, ?, ?, NOW(), ?, 'Not Completed', NULL)";
        
        // Prepare and bind parameters
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssds", $clientID, $jobName, $rank, $jobDescription, $salary, $deadline);
        
        // Execute the query
        $result = $stmt->execute();
        
        // Close statement
        $stmt->close();
        
        return $result; 
    }

    // Method to retrieve job information based on job ID
    public function getJobInfo($jobID) {
        $sql = "SELECT * FROM job WHERE job_ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $jobID);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobInfo = $result->fetch_assoc();
        $stmt->close();
        return $jobInfo;
    }

    // Method to check if the user has already applied for the same job
    public function checkIfUserApplied($userID, $jobID) {
        $sql = "SELECT * FROM applications_list WHERE job_ID = ? AND applicant_ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $jobID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }
}

// Instantiate JobModel with the database connection
$jobModel = new JobModel($conn);
?>
