<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize login status and access level
$access = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store user input and messages
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $login_err = "";

    // If both email and password are provided
    if (!empty($email) && !empty($password)) {
        // Establish a connection to the database
        include '../../db_connection.php';

        // Prepare SQL statement to fetch user info from admin, applicant, and employer tables
            $sql = "SELECT * FROM (
                SELECT 
                    admin_ID AS ID,
                    admin_username AS email, 
                    admin_pwd AS password, 
                    'Admin' AS user_type, 
                    admin_fname AS first_name, 
                    admin_lname AS last_name,
                    NULL AS suffix,
                    NULL AS contact,
                    NULL AS gender,
                    NULL AS age,
                    NULL AS org,
                    NULL AS account_type,
                    NULL AS occ,
                    NULL AS addLine,
                    NULL AS brgy,
                    NULL AS city,
                    NULL AS province,
                    NULL AS educ,
                    NULL AS mstat,
                    NULL AS dob,
                    NULL AS cv, 
                    NULL AS cred,
                    NULL AS license,
                    NULL AS userLevel,
                    NULL AS acc_type
                FROM admin
                UNION 
                SELECT 
                    applicant_ID AS ID,
                    user_email AS email, 
                    user_pwd AS password, 
                    'Applicant' AS user_type, 
                    user_fname AS first_name, 
                    user_lname AS last_name,
                    user_suffix AS suffix,
                    user_contact AS contact,
                    user_gender AS gender,
                    user_age AS age,
                    NULL AS org,
                    NULL AS account_type,
                    NULL AS occ,
                    user_addressLine AS addLine, 
                    user_barangay AS brgy, 
                    user_city AS city, 
                    user_province AS province, 
                    user_educ AS educ,
                    user_mstat AS mstat,
                    user_dob AS dob,
                    user_CV AS cv,
                    user_cred AS cred,
                    user_license AS license,
                    user_level AS userLevel,
                    NULL AS acc_type
                FROM applicant
                UNION 
                SELECT 
                    client_ID AS ID,
                    client_email AS email,
                    client_pwd AS password, 
                    'Employer' AS user_type, 
                    client_fname AS first_name, 
                    client_lname AS last_name,
                    client_suffix AS suffix,
                    client_contact AS contact,
                    NULL AS gender,
                    NULL AS age,
                    account_type,
                    client_organization AS org,
                    client_occupation AS occ,
                    client_addressLine AS addLine, 
                    client_barangay AS brgy, 
                    client_city AS city, 
                    client_province AS province,
                    NULL AS educ,
                    NULL AS mstat,
                    NULL AS dob,
                    NULL AS cv,
                    NULL AS cred,
                    NULL AS license,
                    NULL AS userLevel,
                    account_type AS acc_type
                FROM employer
            ) AS users
            WHERE email = ? AND password = ?";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // echo "Number of rows: " . $result->num_rows;

    // Check if a row is returned
        if ($result->num_rows == 1) {
            // Fetch the row
            $row = $result->fetch_assoc();

            // Start session
            session_start();

            // Store user information in session
            $_SESSION['user_info'] = $row;
            $_SESSION['access'] = $row['user_type']; // Setting the access level in session
            // Redirect to dashboard.php or any other page
            header("Location: ../default/dashboard.php");
            exit();
        } else {
        // Authentication failed
        $login_err = "Invalid email or password";
    }

        // Close database connection
        $conn->close();
    }
}
?>