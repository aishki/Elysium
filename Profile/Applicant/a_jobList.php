<!-- Job List -->
<div class="pOptionDiv pOption_3" id="pOption_3" style="display: none;">

    <div class="job-list-container">
        <div class="ad_acc">List of Jobs Applied</div>

        <?php
        // Check if the applicant has applied for any jobs
        if ($applicationDetails->num_rows > 0) {
            // Display the job applications
            while ($row = $applicationDetails->fetch_assoc()) {
                // Check if the job ID has already been displayed
                if (!in_array($row["job_ID"], $displayedJobIDs)) {
                    // Add the job ID to the displayed IDs array
                    $displayedJobIDs[] = $row["job_ID"];

                    // var_dump($row);
                    echo '
                            <div class="jobContainer" style="height: 270px">
                                <div class= "job_innerdata">
                                    <div class= "header">
                                        <div>
                                            <!-- Job Name -->
                                            <h4 class= "jobName">' . $row["jobName"] . '</h4>
                                            <h4 class= "status">' . "Rank: " . $row["job_rank"] . '</h4>
                                        </div>

                                        <div class = "statusContainer">   
                                            <h4 class= "status">' . $row["job_status"] . '</h4>
                                            <p class="status">Status</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class= "jobrow">                                        
                                        <div class="row1-data">
                                            <!-- Salary -->
                                            <p class= "data">₱' . $row["remuneration"] . '</p>
                                            <p class= "label">Expected Salary </p>
                                        </div>

                                        <div class="row1-data">
                                            <!-- Deadline -->
                                            <p class= "data">' . $row["deadline"] . '</p>
                                            <p class= "label">Deadline</p>
                                        </div>

                                        <div class="row1-data">
                                            <!-- Date Posted -->
                                            <p class= "data">' . $row["dateAdded"] . '</p>
                                            <p class= "label">Date Posted</p>
                                        </div>
                                    </div> <!-- end of row-->

                                    <div class= "jobrow">                                        
                                        <div class="row1-data">
                                            <!-- Salary -->
                                            <p class= "data">₱' . $row["dateApplied"] . '</p>
                                            <p class= "label">Date Applied </p>
                                        </div>
                                    </div> <!-- end of row-->


                                </div>
                            </div>';
                }
            }
        } else {
            // <a href="#" class="view-applicants-link" data-jobid="' . $row["job_ID"] . '">View Task</a>

            // Display a message if the applicant hasn't applied for any jobs yet
            echo '<p>You haven\'t added any tasks yet. Go to the <a href="../../Task_Board/tb/taskboard.php">Taskboard</a> and explore talents!</p>';
        }
        ?>
    </div> <!--job-list-container-->

    <div class="sidebar" id="vm-sidebar">
        <button class="close-sidebar">
            <span class="X"></span>
            <span class="Y"></span>
            <div class="close">Close</div>
        </button>

        <div class="task-info" id="jobDetails">

        </div>




        <hr>
        <div id="applicant-list-container">
            <?php
            // Check if the applicant has applied for any jobs
            if ($applicationDetails->num_rows > 0) {
                // Display the job applications
                while ($row = $applicationDetails->fetch_assoc()) {
                    // Check if the job ID has already been displayed
                    if (!in_array($row["job_ID"], $displayedJobIDs)) {
                        // Add the job ID to the displayed IDs array
                        $displayedJobIDs[] = $row["job_ID"];
                        // Fetch and display applicants for this job
                        $applicants = $profileModel->getApplicantsByJobId($row["job_ID"]);
                        if (!empty($applicants)) {
                            echo '<div class="applicant-details">';
                            echo '<h4>Applicants</h4>';
                            foreach ($applicants as $applicant) {
                                echo '<p>Name: ' . $applicant['user_fname'] . ' ' . $applicant['user_lname'] . '</p>';
                                echo '<p>Contact: ' . $applicant['user_contact'] . '</p>';
                                echo '<p>Level: ' . $applicant['user_level'] . '</p>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No applicants for this job yet.</p>';
                        }
                    }
                }
            }
            ?>
        </div>

    </div>


</div> <!--pOptionDiv-->