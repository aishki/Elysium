<?php
session_start();
error_reporting(E_ALL); 
// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../../Home/log-in/log-in.php");
    exit();
}

// Retrieve user information from session
$currentEmail = $_SESSION['user_info']['email'];
$access = $_SESSION['user_info']['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Board</title>
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/taskboard.css">
</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

<div class="TB_container">

    <div class="TB_header">
        <div class="welcome-container">
            <p class="welcome">Welcome, <?php echo $_SESSION['user_info']['first_name'] . ' ' . $_SESSION['user_info']['last_name']; ?>!</p>
        </div>

        <!-- Add Task only for Employer -->
        <?php if ($access == 'Employer'): ?> 
        <div class="addButton-container">
            <button id="addTaskButton" class="task-button">Add Task</button>
        </div>
        <?php endif; ?>
    </div>

    <div class="TB_listContainer">
        <div class="TB_inner_container">

            <!-- Sorting and filtering options -->
            <!-- <div>
                <label for="sortBy">Sort by:</label>
                <select id="sortBy">
                    <option value="jobName">Job Name</option>
                    <option value="salary">Salary</option>
                    <option value="deadline">Deadline</option>
                    <option value="dateAdded">Date Added</option>
                </select>

                <label for="filterByRank">Filter by Rank:</label>
                <select id="filterByRank">
                    <option value="">All Ranks</option>
                    <option value="S">S-Rank</option>
                    <option value="A">A-Rank</option>
                    <option value="B">B-Rank</option>
                    <option value="C">C-Rank</option>
                    <option value="D">D-Rank</option>
                </select>

                <label for="sortOrder">Sort Order:</label>
                <select id="sortOrder">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>

                <button id="sortButton" class= "task-button">Sort</button>
            </div> -->
        <!-- <div class = "grid"> -->
            <?php
                // Establish a connection to the database
                include '../../db_connection.php';

                // Fetch jobs from the database along with employer information
                $sql = "SELECT job.*, employer.client_fname, employer.client_lname, employer.client_organization, employer.client_occupation
                        FROM job 
                        INNER JOIN employer ON job.client_ID = employer.client_ID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="jobContainer">';
                        echo    '<div class= "job_innerdata">';

                        echo      '<div class= "header">';
                        echo            '<div class="rank-container">';
                        echo                '<div class="rank-box">';
                        echo                    '<h1>'.$row["job_rank"].'</h1>';
                        echo                '</div>';

                        echo                    '<p class= "label"> Rank </p>';
                        echo            '</div>';
                
                        echo            '<div class="heading-container">';
                        echo                '<h3 class= "jobName">'. $row["jobName"] . '</h3>'  ;
                        echo                '<p class= "label"> Status: <span class="data">' . $row["job_status"] . '</span></p>';
                        echo            '</div>';
                        echo      '</div>';

                        echo      '<div class="body-container">';
                        echo             '<br>';
                        echo             '<p class= "label">Job Description: </p>';
                        echo             '<p class= "jobDescription">"'. $row["jobDescription"] . '"</p>';
                        echo             '<br>';

                        echo             '<h3>Employer Details </h3>';

                        echo         '<div class="left-data">';
                        echo             '<p class= "label"> Client Name: <span class="data">' . $row["client_fname"] . ' ' . $row["client_lname"] . '</span></p>';
                        echo             '<p class= "label"> Occupation: <span class="data">' . $row["client_occupation"] . '</span></p>';
                        echo             '<p class= "label"> Company/Organization: <span class="data">' . $row["client_organization"]  . '</span></p>';
                        echo             '<br> <br>';
                        echo         '</div>';

                        echo        '<div class="right-data">';
                        echo             '<p class="data"> ₱' . $row["remuneration"] . '</p>';
                        echo             '<p class= "label">Expected Salary </p>';

                        echo             '<p class="data">' . $row["dateAdded"] . '</p>';
                        echo             '<p class= "label">Date Added </p>';

                        echo             '<p class="data"> ' . $row["deadline"] . '</p>';
                        echo             '<p class= "label"> Deadline </p>';
                        echo        '</div>';
                        echo    '</div>';

                        echo        '<div class= "footer">';
                                            echo '<!-- Apply Task only for applicant -->';
                                            if ($access == 'Applicant') {
                                                echo '<div class="applyButton-container">';
                                                echo '<form class="applyForm" method="POST" action="../tb_controller.php">';
                                                echo '<input type="hidden" name="action" value="apply">';
                                                echo '<input type="hidden" name="jobID" value="' . $row["job_ID"] . '">';
                                                echo '<button type="submit" class="applyTaskButton task-button">Apply Task</button>';
                                                echo '</form>';
                                                echo '</div>';
                                            }
                                            
                                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                                echo '<script>alert("You have successfully applied for this job. Kindly wait for the employer to contact you for possible follow-up questions/interview.");</script>';
                                            }
                        echo        '</div>'; //end of footer

                        echo      '</div>';
                         echo '</div>';                        
                    }
                    } else {
                        echo "0 results";
                    }    

                // Close the connection
                $conn->close();
                
                ?>        <br><br><br> <br><br><br>
        <!-- </div> -->

        </div>
    </div>
</div>

    <div id="addTaskForm" class="form-container" style="display: none;">
        <form class="form-content" id="taskBoardForm" method="POST" action="../tb_controller.php">
            <input type="hidden" name="action" value="create"> <!-- Hidden input to indicate action -->

            <h2>
                Create Task
                <button id="closeFormButton" class="close-button">X</button>
            </h2>
        
            <p><b>Date Today:</b> 
            <span id="currentDate"></span></p>

        
            <div class="row">
                <div class="input-group">
                    <label for="jobName">Job Name</label>
                    <input autocomplete="jobName" type="text" name="jobName" id="jobName" placeholder="Walking a Dog" maxlength="34" required>
                    <div id="charLimitWarning" style="color: red; display: none;">Maximum characters reached</div>
                </div>

                <div class="input-group">
                    <label for="rank">Rank</label>
                        <select id="rank" name="rank" required>
                            <option value="" disabled selected>--Select Rank--</option>
                            <option value="S">S</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                </div>
            </div>

            <div class="input-group">
                <label for="jobDescription">Job Description</label>
                <textarea id="jobDescription" name="jobDescription" placeholder="Describe the job..." required></textarea>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="salary">Salary</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter salary" required>
                </div>
                <div class="input-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" required>
                    <div id="deadlineError" class="error-message" style="display: none;"></div>
                </div>
            </div>

            <div class="button-container">
                <input id="submitButton" type="submit" value="Submit">
            </div>
        </form>
    </div>

<script>
    var userRank = '<?php echo $_SESSION["user_info"]["userLevel"]; ?>';

    // Function to show/hide add task form
    document.getElementById("addTaskButton").addEventListener("click", function() {
        document.getElementById("addTaskForm").style.display = "block";
    });

    // Event listener to the "X" button to close the form
    document.getElementById("closeFormButton").addEventListener("click", function() {
        document.getElementById("addTaskForm").style.display = "none";
    });

    // Get the current date
    var currentDate = new Date();

    // Format the date
    var formattedDate = currentDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    
    // Set the formatted date to the element with id="currentDate"
    document.getElementById("currentDate").innerText = formattedDate;

    // Event listener to the submit button to validate the deadline
    document.getElementById("submitButton").addEventListener("click", function(event) {
        var deadline = document.getElementById("deadline").value;
        var currentDate = new Date();
        var threeDaysLater = new Date(currentDate.getTime() + 3 * 24 * 60 * 60 * 1000); // Calculate three days later

        // Check if the deadline is before today's date
        if (new Date(deadline) < currentDate) {
            event.preventDefault();
            document.getElementById("deadlineError").innerText = "Deadline cannot be before today's date";
            document.getElementById("deadlineError").style.display = "block";
            return;
        }

        if (new Date(deadline) < threeDaysLater) {
            event.preventDefault(); // Prevent form submission
            document.getElementById("deadlineError").innerText = "Deadline should be at least 3 days from today.";
            document.getElementById("deadlineError").style.display = "block"; // Show error message
            return;
        }

        // Check if the deadline exceeds the maximum allowed date (25 years from now)
        var maxDeadlineDate = new Date(currentDate.getFullYear() + 25, currentDate.getMonth(), currentDate.getDate());
        if (new Date(deadline) > maxDeadlineDate) {
            event.preventDefault();
            document.getElementById("deadlineError").innerText = "Deadline should only be at most 25 years from now.";
            document.getElementById("deadlineError").style.display = "block";
            return;
        }

        // Reset error message if all conditions are met
        document.getElementById("deadlineError").innerText = "";
        document.getElementById("deadlineError").style.display = "none";
    });

    document.getElementById('jobName').addEventListener('input', function() {
            var input = this.value;
            var maxLength = 34;

            if (input.length == maxLength) {
                document.getElementById('charLimitWarning').style.display = 'block';
            } else {
                document.getElementById('charLimitWarning').style.display = 'none';
            }
        });
</script>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>