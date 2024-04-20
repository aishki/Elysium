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

<body>
    <?php include '../../navbar/navbar.php'; ?>

        <div class="TB_header">
          <div class="welcome-container">

            <div class="hdr-msg">
                <p class="welcome">Welcome to Elysium, <?php echo $_SESSION['user_info']['first_name'];?>!</p>
                <p class="wlm-msg">Discover your dream career with Elysium! Explore endless opportunities tailored just for you.</p>
            </div>   

          </div>
              

        </div> <!--End of header -->

    <div class="TB_container">

      <div class="TB_listContainer">
  
            <!-- Sorting and filtering options -->
            <div class ="nav-left">
                <div class= filter>
                    <h3>Filters</h3>
                    <button class="value"> Job Name</button>
                    <button class="value"> Salary</button>
                    <button class="value"> Deadline</button>
                    <button class="value"> Date Added</button>
                </div>
                
                <div class="select">
                    <div class="selectedOption"
                            data-default="Filter by Rank"
                            data-one="S-Rank"
                            data-two="A-Rank"
                            data-three="B-Rank"
                            data-four="C-Rank"
                            data-five="D-Rank">
                            
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path
                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                            ></path>
                        </svg>
                    </div>

                    <div class="options">
                        <div title="Select Option">
                            <input id="all" name="option" type="radio" checked="" />
                            <label class="option" for="all" data-txt="Select Option"></label>
                        </div>

                        <div title="S-Rank">
                            <input id="option-S" name="option" type="radio" />
                            <label class="option" for="option-S" data-txt="S-Rank"></label>
                        </div>

                        <div title="A-Rank">
                            <input id="option-A" name="option" type="radio" />
                            <label class="option" for="option-A" data-txt="A-Rank"></label>
                        </div>

                        <div title="B-Rank">
                            <input id="option-B" name="option" type="radio" />
                            <label class="option" for="option-B" data-txt="B-Rank"></label>
                        </div>

                        <div title="C-Rank">
                            <input id="option-C" name="option" type="radio" />
                            <label class="option" for="option-C" data-txt="C-Rank"></label>
                        </div>

                        <div title="D-Rank">
                            <input id="option-D" name="option" type="radio" />
                            <label class="option" for="option-D" data-txt="D-Rank"></label>
                        </div>
                    </div>

                </div>
            </div>

          <div class="TB_inner_container">

            <div class="column">
                <div class="welcome-container">
                    <div class="hdr-msg">
                        <p class="welcome">Tasks</p>
                        <p class="wlm-msg">Discover your dream career with Elysium! Explore endless opportunities tailored just for you.</p>
                    </div>  

                    <!-- Add Task only for Employer -->
                    <?php if ($access == 'Employer'): ?> 
                        <div class="addButton-container">
                            <button id="addTaskButton" class="task-button">
                                <span class="button-content">Add Task</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="SearchGroup">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                    <input placeholder="Search" type="search" class="search_input">
                </div>

                <div class="row3">
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
                            // Define the background image URL based on job rank
                            $background_image_url = '';
                            switch ($row["job_rank"]) {
                                case 'S':
                                    $background_image_url = '../../Assets/S-Rank.jpg';
                                    break;
                                case 'A':
                                    $background_image_url = '../../Assets/A-Rank.jpg';
                                    break;
                                case 'B':
                                    $background_image_url = '../../Assets/B-Rank.jpg';
                                    break;
                                case 'C':
                                    $background_image_url = '../../Assets/C-Rank.jpg';
                                    break;
                                case 'D':
                                    $background_image_url = '../../Assets/D-Rank.jpg';
                                    break;
                                default:
                                    // Default background image if job rank doesn't match any case
                                    $background_image_url = 'default-image.jpg';
                                    break;
                            }
                    //   echo  '<div class="jobContainer">                                                                           ';
                    //   echo  '   <div class= "job_innerdata">                                                                      ';

                    echo  '     <ul class="cards">                                                                              ';
                    echo  '       <li>                                                                                          ';
                    echo  '         <a href="" class="card" style="background-image: url(\'' . $background_image_url . '\');">  ';
    
                    echo  '           <div class="card__overlay">                                                               ';
                    echo  '             <div class="card__header">                                                              ';

                    echo  '               <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">                            ';
                    echo  '                 <!--curvy arc-->                                                                    ';
                    echo  '                 <path />                                                                            ';
                    echo  '               </svg>                                                                                ';

                    echo  '               <div class="rank__box">                                                               ';
                    echo  '                 <h1>'.$row["job_rank"].'</h1>                                                       ';
                    echo  '               </div>                                                                                ';

                    echo  '               <div class="card__header-text">                                                       ';
                    echo  '                 <h3 class="jobName">                                                                ';
                    echo                     $row["jobName"]                                                                     ;
                    echo  '                 </h3>                                                                               ';
                    echo  '                 <span class="card__status"> Status: ' . $row["job_status"]. '</span>                ';
                    echo  '               </div>                                                                                ';

                    echo  '             </div>                                                                                  '; //ends card__header
                    echo  '             <hr class="Hhr">                                                                        ';

                    echo  '   <div class="d3-2">                                                                                ';
                    echo  '   <div class="d4">                                                                                  ';
                    echo  '    <div class="body-container">                                                                     ';
                    echo  '             <div class="card__description">                                                         ';
                    echo  '               <h3 class="label">Job Description:</h3>                                               ';
                    echo                 $row["jobDescription"]                                                                  ;
                    echo  '             </div>                                                                                  ';
                    
                    echo  '    <div class="xtraDeets">                                                                          ';
                    echo  '      <div class="t-data">                                                                           ';
                    echo  '        <div class="row2">                                                                           ';

                    echo  '         <div class="column">                                                                        ';
                    echo  '           <p class="data"> ₱' . $row["remuneration"] . '</p>                                        ';
                    echo  '           <p class= "label">Salary</p>                                                    ';
                    echo  '         </div>                                                                                      ';

                    echo  '         <div class="column">                                                                        ';
                    echo  '           <p class="data">' . date('d-M-y', strtotime($row["dateAdded"])) . '</p>                                             ';
                    echo  '           <p class= "label">Date Added </p>                                                         ';
                    echo  '         </div>                                                                                      ';
                    
                    echo  '         <div class="column">                                                                        ';
                    echo  '           <p class="data">' . date('d-M-y', strtotime($row["deadline"])) . '</p>                                             ';
                    echo  '           <p class= "label"> Deadline </p>                                                          ';
                    echo  '         </div>                                                                                      ';
                    echo  '        </div>                                                                                       '; //end of row2
                    echo  '     </div>                                                                                          ';
                    
                    echo  '     <hr class="Bhr">                                                                                ';
                                
                    echo  '       <div class="employer-details">                                                                ';
                    echo  '         <h3>Employer Details </h3>                                                                  ';
                    echo  '           <p class= "label"> Client Name: <span class="data">' . $row["client_fname"] . ' ' . $row["client_lname"] . '</span></p>';
                    echo  '           <p class= "label"> Occupation: <span class="data">' . $row["client_occupation"] . '</span></p>                         ';
                    echo  '           <p class= "label"> Company/Organization: <span class="data">' . $row["client_organization"]  . '</span></p>            ';
                    echo  '           <br> <br>                                                                  ';
                    echo  '       </div>                                                                         ';
                    
                    echo '    <div class= "footer">                                                           ';
                    echo '<!-- Apply Task only for applicant -->                                                 ';
                        if ($access == 'Applicant') {
                            echo '<div class="applyButton-container">';
                            echo '<form class="applyForm" method="POST" action="../tb_controller/tb_controller.php">           ';
                            echo '<input type="hidden" name="action" value="apply">                              ';
                            echo '<input type="hidden" name="jobID" value="' . $row["job_ID"] . '">              ';
                            echo '<button type="submit" class="applyTaskButton apply-button">                    ';
                            echo '  <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">    ';
                            echo '    <path                                                                         ';
                            echo '      d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"';
                            echo '    ></path> ';
                            echo '  </svg> ';
                            echo '<span class="text">Apply Task</span> ';
                            echo '  <span class="circle"></span> ';
                            echo '    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">';
                            echo '      <path';
                            echo '        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"';
                            echo '      ></path>';
                            echo '    </svg>';


                            echo '</button>  ';
                            
                            
                            echo '</form>                                                                        ';
                            echo '</div>                                                                         ';
                        }
                        
                        if (isset($_GET['success']) && $_GET['success'] == 1) {
                            echo '<script>alert("You have successfully applied for this job. Kindly wait for the employer to contact you for possible follow-up questions/interview.");</script>';
                        }
                    echo '      </div>                                                                            '; //end of footer

                    echo  '  </div>                                                                              '; //end of xtraDeets
                                                                                                        
                    echo  '  </div>                                                                              '; //end body-container
                    echo  '  </div>                                                                              '; //end d3-2
                    echo  '  </div>                                                                              '; //end d4
                            
                    echo  '           </div>                                                                     '; //ends card__overlay
                    echo  '         </a>                                                                         ';
                    echo  '       </li>                                                                          ';
                    echo  '     </ul>                                                                            ';
                    
        
                                                                                                    
                    // echo '    </div>                                                                              ';
                    // echo '</div>                                                                                  ';                        
                    }                                                                              
                    } else {                                                                               
                    echo "0 results"                                                                               ;
                    }    
                    
                    // Close the connection
                    $conn->close();
                    
                    ?>        <br><br><br> <br><br><br>
                    <!-- </div> -->
    
                </div> <!--End of row3-->
          
            </div> <!--End of column-->
          </div> <!--End of TB_inner_container-->
      </div> <!--End of TBListContainer-->
  </div> <!--End of TBContainer-->
  
  
  <div id="addTaskForm" class="form-container" style="display: none;">
        <form class="form-content" id="taskBoardForm" method="POST" action="../tb_controller/tb_controller.php">
            <input type="hidden" name="action" value="create"> <!-- Hidden input to indicate action -->

            <h2>
                Create Task
                <button id="closeFormButton" class="close-button">X</button>
            </h2>
                <p class ="shrt-msg"> Empower your team: Create opportunities, connect with talent, and build a brighter future together!</p>
            <hr>
        
            <p class= "date"><b>Date Today:</b> 
            <span id="currentDate"></span></p>

        
            <div class="row">
                <div class="input-group">
                    <label for="jobName">Job Name</label>
                    <input autocomplete="jobName" type="text" name="jobName" id="jobName" placeholder="Walking a Dog" maxlength="34" required>
                    <div id="charLimitWarning1" style="font-size: 12px; color: red; display: none;">Maximum characters reached</div>
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
                <textarea id="jobDescription" name="jobDescription" placeholder="Describe the job..." maxlength="100" required></textarea>
                <div id="charLimitWarning2" style="font-size: 12px; color: red; display: none;">Maximum characters reached</div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="salary">Salary</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter salary" required>
                </div>
                <div class="input-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" required>
                    <div id="deadlineError" class="error-message" style="font-size: 12px; color: red; display: none;"></div>
                </div>
            </div>

            <div>
                <button id="submitButton" class="submit--btn">Submit</button>
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
                document.getElementById("deadlineError").innerText = "Date must not precede the current date.";
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
                    document.getElementById('charLimitWarning1').style.display = 'block';
                } else {
                    document.getElementById('charLimitWarning1').style.display = 'none';
                }
            }); 

        document.getElementById('jobDescription').addEventListener('input', function() {
            var textarea = this.value;
            var maxLength = 100;

            if (textarea.length == maxLength) {
                document.getElementById('charLimitWarning2').style.display = 'block';
            } else {
                document.getElementById('charLimitWarning2').style.display = 'none';
            }
            }); 

        // Event listener for the scroll event with limit
        // window.addEventListener('scroll', function() {
        //     // Select the navbar element
        //     var navbar = document.querySelector('.navbar');

        //     // Calculate 40% of the viewport height
        //     var threshold = window.innerHeight * 0.4;

        //     // Check the scroll position
        //     if (window.scrollY > threshold) {
        //         navbar.classList.add('scrolled');
        //     } else {
        //         // Otherwise, remove the class
        //         navbar.classList.remove('scrolled');
        //     }
        // });

        // Add an event listener for the scroll event
        window.addEventListener('scroll', function() {
            // Select the navbar element
            var navbar = document.querySelector('.navbar');

            // Check the scroll position
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                // Otherwise, remove the class
                navbar.classList.remove('scrolled');
            }
        });
    </script> 

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="tb_script.js"></script>
</body>
</html>