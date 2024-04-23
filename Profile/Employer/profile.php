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

// For JOB LIST & APPLICANT LIST
$profileModel = new ProfileModel();

// Fetch the jobs applied by the current user
$applicationDetails = $profileModel->getApplicationsByUserID($user_id, $user_role);

// Initialize an array to store displayed job IDs
$displayedJobIDs = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../../Assets/css/navbar_v2.css">
    <link rel="stylesheet" href="../../Assets/css/profile.css">
    <link rel="stylesheet" href="../../Assets/css/jobList.css">

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
                                // Output the employer's first name and last name
                                echo "<p class=\"u_name\">" . $user_fn . " " . $user_ln . " " . $user_sufx_display . "</p>";
                            ?>
                            <span class = "u_info">Employer Account</span> 
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

                        <div class="input-group">
                            <label for="employerType">Employer Type</label>
                            <input type="text" name="employerType" value="<?php echo $user_acc_type; ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="org">Company/Organization</label>
                            <input type="text" name="org" value="<?php echo $user_organization; ?>" readonly>
                        </div>

                        <div class="input-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" value="<?php echo $user_occ; ?>" readonly>
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
            <?php include 'e_modProf.php'?>



        <!-- Job List -->
            <?php include 'e_jobList.php'?>
    </div>
    
    <script src="../p_script.js"></script>
    
</body>
</html>