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

// Initialize an array to store displayed job IDs
$displayedJobIDs = [];

// Check if the applicant has applied for any jobs
if ($applicationDetails->num_rows > 0) {
    // Display the job applications
    while ($row = $applicationDetails->fetch_assoc()) {
        // Check if the job ID has already been displayed
        if (!in_array($row["job_ID"], $displayedJobIDs)) {
            // Add the job ID to the displayed IDs array
            $displayedJobIDs[] = $row["job_ID"];

            echo '
            <div class="jobContainer">
                <div class= "job_innerdata">
                    <div class= "header">
                        <!-- Job Name -->
                        <h4 class= "jobName">' . $row["jobName"] . '</h4>
                        <hr>
                    </div>

                    <div class= "jobrow">
                        <div class="left-data">
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
                        
                        <div class="right-data">
                            <div class= "statusContainer">
                                <h4 class= "status">' . $row["application_status"] . '</h4>
                                <p class= "label">Status </p>
                            </div>

                            <!-- Deadline -->
                            <p class= "data">' . $row["deadline"] .'</p>
                            <p class= "label">Deadline</p>
                        </div>
                    </div> <!-- end of row-->

                    <a href="#" class="view-applicants-link" data-job-id="' . $row["job_ID"] . '">View Applicants</a>
                    <!-- when application_status is changed to "Ongoing" show buttons for "Task Complete" -->
                </div>
            </div>';
        }
    }
} else {
    // Display a message if the applicant hasn't applied for any jobs yet
    echo '<p>You haven\'t added any tasks yet. Go to the <a href="../../Task_Board/TB/taskboard.php">Taskboard</a> and explore talents!</p>';
}
?>


<div id="vm-sidebar">
    <button class="close-sidebar">X</button>
    <div id="applicant-list-container"></div>
    
</div>

<script>
// JS for view more sidebar in job list
document.addEventListener('DOMContentLoaded', function () {
    const viewApplicantsLink = document.querySelectorAll('.view-applicants-link');
    const sidebar = document.getElementById('vm-sidebar');
    const closeSidebarButton = sidebar.querySelector('.close-sidebar');
    const applicantListContainer = document.getElementById('applicant-list-container');

    // Event listener for the "View Applicants" links
    viewApplicantsLink.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const jobId = this.dataset.jobId;
            fetchApplicantsByJobId(jobId); // Corrected function name
            sidebar.style.left = '0';
        });
    });

    // Event listener for the close button
    closeSidebarButton.addEventListener('click', function () {
        sidebar.style.left = '-500px';
    });

    function fetchApplicantsByJobId(jobId) { // Corrected function name
        // Make AJAX request to fetch applicants for the given job ID
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_applicants.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                displayApplicants(response);
            } else {
                console.error('Failed to fetch applicants: ' + xhr.status);
            }
        };
        xhr.send('jobId=' + encodeURIComponent(jobId));
    }

    function displayApplicants(applicants) {
        // Clear previous content
        applicantListContainer.innerHTML = '';
        // Display each applicant
        applicants.forEach(applicant => {
            const applicantContainer = document.createElement('div');
            applicantContainer.classList.add('applicant-container');

            const applicantBox = document.createElement('div');
            applicantBox.classList.add('applicant-box');

            const rankParagraph = document.createElement('h1');
            rankParagraph.textContent = `${applicant.user_level}`;
            rankParagraph.classList.add('applicant_level');


            const nameParagraph = document.createElement('p');
            nameParagraph.textContent = `${applicant.user_fname} ${applicant.user_lname}`;

            const credentialParagraph = document.createElement('p');
            credentialParagraph.textContent = `Credential: ${applicant.user_cred}`;

            const viewProfileButton = document.createElement('button');
            viewProfileButton.textContent = 'View Profile';

            const hrline = document.createElement('hr');
            
            const rowContainer = document.createElement('div');

            const approveButton = document.createElement('button');
            approveButton.textContent = 'Approve';
            const declineButton = document.createElement('button');
            declineButton.textContent = 'Decline';

            rankParagraph.classList.add('jobrow');

            // Append elements to applicant box
            applicantBox.appendChild(rankParagraph);
            applicantBox.appendChild(nameParagraph);
            applicantBox.appendChild(credentialParagraph);
            applicantBox.appendChild(viewProfileButton);
            applicantBox.appendChild(rowContainer);
            applicantBox.appendChild(approveButton);
            applicantBox.appendChild(declineButton);

            // Append applicant box to applicant container
            applicantContainer.appendChild(applicantBox);

            // Append applicant container to applicant list container
            applicantListContainer.appendChild(applicantContainer);
        });
    }

    // Event listener for the "Approve" buttons
    const approveButtons = document.querySelectorAll('.approve-button');
    approveButtons.forEach(button => {
        button.addEventListener('click', function () {
            const applicationID = this.dataset.applicationID;
            updateApplicationStatus(applicationID, 'Ongoing');
        });
    });

    // Event listener for the "Decline" buttons
    const declineButtons = document.querySelectorAll('.decline-button');
    declineButtons.forEach(button => {
        button.addEventListener('click', function () {
            const applicationID = this.dataset.applicationID;
            updateApplicationStatus(applicationID, 'Rejected');
        });
    });

    function updateApplicationStatus(applicationID, status) {
    // Make AJAX request to update application status
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_status.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Handle success response
            console.log('Application status updated successfully');
            // Reload the page or perform any other necessary actions
            location.reload(); // Reload the page
        } else {
            console.error('Failed to update application status: ' + xhr.status);
        }
    };
    xhr.send(`applicationID=${applicationID}&status=${status}`);
}

});





</script>