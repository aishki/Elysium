<?php
session_start();
require_once '../p_model/ProfileModel.php';

// Check if the user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();

} else if (isset($_SESSION['user_info'])) {
    // Fetch the session details
    $user_fn = isset($_SESSION['user_info']['first_name']) ? $_SESSION['user_info']['first_name'] : '';
    $user_ln = isset($_SESSION['user_info']['last_name']) ? $_SESSION['user_info']['last_name'] : '';
    $user_sufx = isset($_SESSION['user_info']['suffix']) ? $_SESSION['user_info']['suffix'] : '';

    // Set user_sufx to empty string if it's "N/A" or NULL
    $user_sufx_display = ($user_sufx == "N/A" || is_null($user_sufx)) ? '' : $user_sufx;
       

    // Profile Picture
    $user_role = isset($_SESSION['user_info']['user_type']) ? $_SESSION['user_info']['user_type'] : '';
    $user_id = isset($_SESSION['user_info']['ID']) ? $_SESSION['user_info']['ID'] : '';

    // Account Details
    $user_email = isset($_SESSION['user_info']['email']) ? $_SESSION['user_info']['email'] : '';
    $user_contact = isset($_SESSION['user_info']['contact']) ? $_SESSION['user_info']['contact'] : '';
    $user_organization = isset($_SESSION['user_info']['org']) ? $_SESSION['user_info']['org'] : '';
    $user_occ = isset($_SESSION['user_info']['occ']) ? $_SESSION['user_info']['occ'] : '';
    $user_addL = isset($_SESSION['user_info']['addLine']) ? $_SESSION['user_info']['addLine'] : '';
    $user_brgy = isset($_SESSION['user_info']['brgy']) ? $_SESSION['user_info']['brgy'] : '';
    $user_city = isset($_SESSION['user_info']['city']) ? $_SESSION['user_info']['city'] : '';
    $user_prov = isset($_SESSION['user_info']['province']) ? $_SESSION['user_info']['province'] : '';
    $user_acc_type = isset($_SESSION['user_info']['acc_type']) ? $_SESSION['user_info']['acc_type'] : '';

    $user_gender = isset($_SESSION['user_info']['gender']) ? $_SESSION['user_info']['gender'] : '';
    $user_mstat = isset($_SESSION['user_info']['cstat']) ? $_SESSION['user_info']['cstat'] : '';
    $user_age = isset($_SESSION['user_info']['age']) ? $_SESSION['user_info']['age'] : '';
    $user_dob = isset($_SESSION['user_info']['dob']) ? $_SESSION['user_info']['dob'] : '';
    $user_lvl = isset($_SESSION['user_info']['userLevel']) ? $_SESSION['user_info']['userLevel'] : '';
    $user_license = isset($_SESSION['user_info']['license']) ? $_SESSION['user_info']['license'] : '';
    $user_cred = isset($_SESSION['user_info']['cred']) ? $_SESSION['user_info']['cred'] : '';
    $user_CV = isset($_SESSION['user_info']['cv']) ? $_SESSION['user_info']['cv'] : '';
    

} else {
    // Handle if the user is not logged in
    echo "You are not logged in.";
}

// Sanitize and validate input data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "modify") {
    // Handle form submission securely
    $currentEmail = $_POST['currentEmail'];
    $newEmail = htmlspecialchars($_POST['newEmail']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $currentPassword = htmlspecialchars($_POST['pwd']);

    // Validate input data
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email address
    } else {
        // hash the new password securely before storing it in the database
    }
}

// Profile Pic PHP is in nav
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../../Assets/css/navbar_v2.css">
    <link rel="stylesheet" href="../../Assets/css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="default">
    <div class= "main-container">

        <div class="side-bar">
            <?php include '../../navbar/navbar_v2.php'; ?>

            <!-- Sidebar -->
            <div class= "side-options">
                <h5 class= "p-hdr">Profile</h5>

                <button class="p_option" data-corresponding-div="pOption_1">
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m1.5 13v1a.5.5 0 0 0 .3379.4731 18.9718 18.9718 0 0 0 6.1621 1.0269 18.9629 18.9629 0 0 0 6.1621-1.0269.5.5 0 0 0 .3379-.4731v-1a6.5083 6.5083 0 0 0 -4.461-6.1676 3.5 3.5 0 1 0 -4.078 0 6.5083 6.5083 0 0 0 -4.461 6.1676zm4-9a2.5 2.5 0 1 1 2.5 2.5 2.5026 2.5026 0 0 1 -2.5-2.5zm2.5 3.5a5.5066 5.5066 0 0 1 5.5 5.5v.6392a18.08 18.08 0 0 1 -11 0v-.6392a5.5066 5.5066 0 0 1 5.5-5.5z" fill="#7D8590"></path></svg>
                    Account Details
                </button>

                <button class="p_option" data-corresponding-div="pOption_2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="Line"><path d="m17.074 30h-2.148c-1.038 0-1.914-.811-1.994-1.846l-.125-1.635c-.687-.208-1.351-.484-1.985-.824l-1.246 1.067c-.788.677-1.98.631-2.715-.104l-1.52-1.52c-.734-.734-.78-1.927-.104-2.715l1.067-1.246c-.34-.635-.616-1.299-.824-1.985l-1.634-.125c-1.035-.079-1.846-.955-1.846-1.993v-2.148c0-1.038.811-1.914 1.846-1.994l1.635-.125c.208-.687.484-1.351.824-1.985l-1.068-1.247c-.676-.788-.631-1.98.104-2.715l1.52-1.52c.734-.734 1.927-.779 2.715-.104l1.246 1.067c.635-.34 1.299-.616 1.985-.824l.125-1.634c.08-1.034.956-1.845 1.994-1.845h2.148c1.038 0 1.914.811 1.994 1.846l.125 1.635c.687.208 1.351.484 1.985.824l1.246-1.067c.787-.676 1.98-.631 2.715.104l1.52 1.52c.734.734.78 1.927.104 2.715l-1.067 1.246c.34.635.616 1.299.824 1.985l1.634.125c1.035.079 1.846.955 1.846 1.993v2.148c0 1.038-.811 1.914-1.846 1.994l-1.635.125c-.208.687-.484 1.351-.824 1.985l1.067 1.246c.677.788.631 1.98-.104 2.715l-1.52 1.52c-.734.734-1.928.78-2.715.104l-1.246-1.067c-.635.34-1.299.616-1.985.824l-.125 1.634c-.079 1.035-.955 1.846-1.993 1.846zm-5.835-6.373c.848.53 1.768.912 2.734 1.135.426.099.739.462.772.898l.18 2.341 2.149-.001.18-2.34c.033-.437.347-.8.772-.898.967-.223 1.887-.604 2.734-1.135.371-.232.849-.197 1.181.089l1.784 1.529 1.52-1.52-1.529-1.784c-.285-.332-.321-.811-.089-1.181.53-.848.912-1.768 1.135-2.734.099-.426.462-.739.898-.772l2.341-.18h-.001v-2.148l-2.34-.18c-.437-.033-.8-.347-.898-.772-.223-.967-.604-1.887-1.135-2.734-.232-.37-.196-.849.089-1.181l1.529-1.784-1.52-1.52-1.784 1.529c-.332.286-.81.321-1.181.089-.848-.53-1.768-.912-2.734-1.135-.426-.099-.739-.462-.772-.898l-.18-2.341-2.148.001-.18 2.34c-.033.437-.347.8-.772.898-.967.223-1.887.604-2.734 1.135-.37.232-.849.197-1.181-.089l-1.785-1.529-1.52 1.52 1.529 1.784c.285.332.321.811.089 1.181-.53.848-.912 1.768-1.135 2.734-.099.426-.462.739-.898.772l-2.341.18.002 2.148 2.34.18c.437.033.8.347.898.772.223.967.604 1.887 1.135 2.734.232.37.196.849-.089 1.181l-1.529 1.784 1.52 1.52 1.784-1.529c.332-.287.813-.32 1.18-.089z" id="XMLID_1646_" fill="#7D8590"></path><path d="m16 23c-3.859 0-7-3.141-7-7s3.141-7 7-7 7 3.141 7 7-3.141 7-7 7zm0-12c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" fill="#7D8590" id="XMLID_1645_"></path></svg>
                    Modify Account
                </button>

                <button class="p_option" data-corresponding-div="pOption_3">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 11.25H16.5V12.75H10.5V11.25Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 7.5H16.5V9H10.5V7.5Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 15H16.5V16.5H10.5V15Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 7.5H9V9H7.5V7.5Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 11.25H9V12.75H7.5V11.25Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 15H9V16.5H7.5V15Z" fill="#7D8590"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 4.5L4.5 3.75H19.5L20.25 4.5V19.5L19.5 20.25H4.5L3.75 19.5V4.5ZM5.25 5.25V18.75H18.75V5.25H5.25Z" fill="#7D8590"></path> </g></svg>
                    Job List
                </button>

                <button class="p_option" data-corresponding-div="pOption_4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path d="m109.9 20.63a6.232 6.232 0 0 0 -8.588-.22l-57.463 51.843c-.012.011-.02.024-.031.035s-.023.017-.034.027l-4.721 4.722a1.749 1.749 0 0 0 0 2.475l.341.342-3.16 3.16a8 8 0 0 0 -1.424 1.967 11.382 11.382 0 0 0 -12.055 10.609c-.006.036-.011.074-.015.111a5.763 5.763 0 0 1 -4.928 5.41 1.75 1.75 0 0 0 -.844 3.14c4.844 3.619 9.4 4.915 13.338 4.915a17.14 17.14 0 0 0 11.738-4.545l.182-.167a11.354 11.354 0 0 0 3.348-8.081c0-.225-.02-.445-.032-.667a8.041 8.041 0 0 0 1.962-1.421l3.16-3.161.342.342a1.749 1.749 0 0 0 2.475 0l4.722-4.722c.011-.011.018-.025.029-.036s.023-.018.033-.029l51.844-57.46a6.236 6.236 0 0 0 -.219-8.589zm-70.1 81.311-.122.111c-.808.787-7.667 6.974-17.826 1.221a9.166 9.166 0 0 0 4.36-7.036 1.758 1.758 0 0 0 .036-.273 7.892 7.892 0 0 1 9.122-7.414c.017.005.031.014.048.019a1.717 1.717 0 0 0 .379.055 7.918 7.918 0 0 1 4 13.317zm5.239-10.131c-.093.093-.194.176-.293.26a11.459 11.459 0 0 0 -6.289-6.286c.084-.1.167-.2.261-.3l3.161-3.161 6.321 6.326zm7.214-4.057-9.479-9.479 2.247-2.247 9.479 9.479zm55.267-60.879-50.61 56.092-9.348-9.348 56.092-50.61a2.737 2.737 0 0 1 3.866 3.866z" fill="#7D8590"></path></svg>
                    Additional Files
                </button>
            </div>
        </div>
        
        <div class="p_container">
        <!-- Account Details -->
        <div class= "pOptionDiv pOption_1" id= "pOption_1" style="display: none;">
            <div class= "u_account">
                <span class = "u_acc">User Account</span> <br>
                <span class = "u_info">View your account photo and details here</span> 
                
                <div class= "mod">
                    <div class = "p_info_container">
                        <img src="<?php echo $profile_pic_src; ?>" id="output" width="150" />
                    
                        <div class= "user">
                            <?php 
                                // Output the applicant's first name and last name
                                echo "<p class=\"u_name\">" . $user_fn . " " . $user_ln . " " . $user_sufx_display . "</p>";
                            ?>
                            <span class = "u_info">Applicant Account</span> 
                        </div>
                    </div>

                    <form action="../log-out.php" method="post">
                        <div class="LO-container">
                            <button class="logOutBtn">
                                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                                <div class="text">Logout</div>
                            </button>
                        </div>
                    </form>                
                </div>

                <hr class= "p_hr">

                <div class="acc_details">
                    <div class = "ad_acc">Account Details</div> 

                    <div class="row">
                        <div class="input-group">
                            <label for="firstName">First Name</label>
                            <input type="text" name="fname" value="<?php echo $user_fn; ?>" readonly>
                        </div>

                        <div class="input-group">
                            <label for="lastName">Surname</label>
                            <input type="text" name="lname" value="<?php echo $user_ln; ?>" readonly>
                        </div>

                        <div class="input-group">
                            <label for="suffix">Suffix</label>
                            <input type="text" name="sufx" value="<?php echo $user_sufx_display; ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?php echo $user_email; ?>" readonly>
                        </div>

                        <div class="input-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" name="contact" value="<?php echo $user_contact; ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="<?php echo $user_addL . ', ' . $user_brgy . ', ' . $user_city . ', ' . $user_prov; ?>" readonly>
                        </div>
                    </div>
                </div> <!-- end Account Details -->
            </div>
        </div>

        <!-- Modify Account -->
        <div class="pOptionDiv pOption_2" id="pOption_2" style="display: none;">
            <div class="u_account">
                <span class="u_acc">Modify Account</span> <br>
                <span class="u_info">Update your account photo and details here</span>

                <div class="p_info_container">
                    <div class="mod">
                        <form action="../upload.php" class="profile_upload" method="post" enctype="multipart/form-data">
                            <div class="profile-pic">
                                <label class="-label" for="file">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <span>Change Image</span>
                                </label>
                                <input id="file" type="file" name="file" onchange="loadFile(event)" />
                                <img src="<?php echo $profile_pic_src; ?>" id="output" width="200" />
                            </div>

                            <div class="prof">
                                <div class="user">
                                    <?php 
                                        // Output the applicant's first name and last name
                                        echo "<p class=\"u_name\">" . $user_fn . " " . $user_ln . " " . $user_sufx_display . "</p>";
                                    ?>
                                    <span class="u_info">Applicant Account</span>
                                </div>

                                <button type="submit" id="uploadPhotoButton" class="task-button" name="submit">
                                    <span class="button-content">Upload Photo</span>
                                </button>
                            </div>
                        </form>
                    </div> <!-- end mod -->
                </div>

                <hr class="p_hr">

                <div class="mod_details">
                    <div class="ad_acc">Modify Details</div>

                    <form id="modifyForm" action="../p_update/save_changes.php" method="post">
                        <div class="row">
                            <div class="input-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="fname" value="<?php echo $user_fn; ?>" />
                            </div>

                            <div class="input-group">
                                <label for="lastName">Surname</label>
                                <input type="text" name="lname" value="<?php echo $user_ln; ?>" />
                            </div>

                            <div class="input-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" name="sufx" value="<?php echo empty($user_sufx) ? 'N/A' : $user_sufx; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="<?php echo $user_email; ?>">
                            </div>

                            <div class="input-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" name="contact" value="<?php echo $user_contact; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" value="<?php echo $user_addL . ', ' . $user_brgy . ', ' . $user_city . ', ' . $user_prov; ?>">
                            </div>
                        </div>

                        <button id="saveChangesButton" class="task-button" onclick="saveChanges()">
                            <span class="button-content">Save Changes</span>
                        </button>
                    </form>
                </div> <!-- end Modify Details -->

                

            </div>
        </div>


        <!-- Job List -->
        <div class= "pOptionDiv pOption_3" id= "pOption_3" style="display: none;">
        <div class = "ad_acc">List of Jobs Applied</div> 

            <div class= "job-list-container">
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
                            <div class="jobContainer">
                                <div class= "job_innerdata">
                                    <div class= "header">
                                        <!-- Job Name -->
                                        <h4 class= "jobName">' . $row["jobName"] . '</h4>

                                        <div class= "statusContainer">
                                        <p class= "label">Status:  </p>
                                        <h4 class= "status">' . "&nbsp;&nbsp;&nbsp;" . $row["job_status"] . '</h4>
                                        </div>

                                    </div>
                                    <hr>

                                    <div class= "jobrow">
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

                                            <!-- Date Posted -->
                                            <p class= "data">' . $row["dateAdded"] . '</p>
                                            <p class= "label">Date Posted</p>

                                        </div>
                                        
                                        <div class="t-data">
                                            <!-- Deadline -->
                                            <p class= "data">' . $row["deadline"] .'</p>
                                            <p class= "label">Deadline</p>
                                        </div>
                                    </div> <!-- end of row-->

                                    <a href="#" class="view-applicants-link" data-job-id="' . $row["job_ID"] . '">View Applicants</a>
                                    <!-- when application_status is changed to "Ongoing" show buttons for "Task Complete" -->
                        if ($access == 'Applicant') {
                                    
                                    <button type="submit" id="uploadPhotoButton" class="task-button" name="submit">
                                        <span class="button-content">Upload Photo</span>
                                    </button>
                        }
                                </div>
                            </div>';
                        }
                    }

                    
                } else {
                    // Display a message if the applicant hasn't applied for any jobs yet
                    echo '<p>You haven\'t added any tasks yet. Go to the <a href="../../Task_Board/tb/taskboard.php">Taskboard</a> and explore talents!</p>';
                }
                ?>


                <div id="vm-sidebar">
                    <button class="close-sidebar">X</button>

                    
                    </div>
                    
                </div>
            </div> <!--job-list-container-->
</div>
        </div>

        <!-- Additional Files -->
        <div class= "pOptionDiv pOption_4" id= "pOption_4" style="display: none;">
        </div>

        </div> <!--end p_container -->


    </div>
    
    <script src="../p_script.js"></script>
    
</body>
</html>

<?php // Output the applicant's first name and last name
    // echo "<p class=\"name\">" . $user_fn . " " . $user_ln . " " . $user_sufx . "</p>";?>

        <!-- <form action="../upload.php" class="profile_upload" method="post" enctype="multipart/form-data">
            <div class="profile-pic">
                <label class="-label" for="file">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Change Image</span>
                </label>
                <input id="file" type="file" name="file" onchange="loadFile(event)"/>
                <img src="<//?php echo $profile_pic_src; ?>" id="output" width="200" />
            </div>

            <button type="submit" id="uploadPhotoButton" class="task-button" name="submit">
                <span class="button-content">Upload Photo</span>
            </button>
        </form>


        <form action="../log-out.php" method="post">
            <div class="LO-container">
                <button class="logOutBtn">
                    <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                    <div class="text">Logout</div>
                </button>
            </div>
        </form> -->