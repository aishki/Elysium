<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ProfileModel
{
    // Database connection
    private $conn;

    // Constructor to initialize the database connection
    public function __construct()
    {
        // Check if the file ../../db_connection.php exists
        $customPath = '../../db_connection.php';
        if (file_exists($customPath)) {
            // Include ../../db_connection.php if it exists
            $this->conn = include $customPath;
        } else {
            // Include ../db_connection.php if ../../db_connection.php does not exist
            $this->conn = include '../db_connection.php';
        }
    }


    // Check if the new email is unique across tables (applicant, employer, admin)
    public function isEmailUnique($email)
    {
        $stmt1 = $this->conn->prepare("SELECT COUNT(*) as count FROM applicant WHERE user_email = ?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_assoc();
        $count1 = $row1['count'];
        $stmt1->close();

        $stmt2 = $this->conn->prepare("SELECT COUNT(*) as count FROM employer WHERE client_email = ?");
        $stmt2->bind_param("s", $email);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        $count2 = $row2['count'];
        $stmt2->close();

        return ($count1 + $count2) == 0; // If count is 0, email is unique
    }

    // Update user's email
    public function updateEmail($userID, $email)
    {

        $stmt1 = $this->conn->prepare("UPDATE applicant SET user_email = ? WHERE applicant_ID = ?");
        $stmt1->bind_param("si", $email, $userID);
        if ($stmt1->execute()) {
            $_SESSION['user_info']['email'] = $email; // Update email in session
        } else {
            echo "Error updating applicant email: " . $stmt1->error . "<br>";
        }
        $stmt1->close();

        $stmt2 = $this->conn->prepare("UPDATE employer SET client_email = ? WHERE client_ID = ?");
        $stmt2->bind_param("si", $email, $userID);
        if ($stmt2->execute()) {
            $_SESSION['user_info']['email'] = $email; // Update email in session
        } else {
            echo "Error updating employer email: " . $stmt2->error . "<br>";
        }
        $stmt2->close();
    }

    // Update user's password
    public function updatePassword($userID, $password)
    {
        // Hash the new password
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt1 = $this->conn->prepare("UPDATE applicant SET user_pwd = ? WHERE applicant_ID = ?");
        $stmt1->bind_param("si", $password, $userID);
        if ($stmt1->execute()) {
            // Update password in the current session
            $_SESSION['user_info']['password'] = $password;
        } else {
            echo "Error updating applicant password: " . $stmt1->error . "<br>";
        }
        $stmt1->close();

        $stmt2 = $this->conn->prepare("UPDATE employer SET client_pwd = ? WHERE client_ID = ?");
        $stmt2->bind_param("si", $password, $userID);
        if ($stmt2->execute()) {
            // Update password in the current session
            $_SESSION['user_info']['password'] = $password;
        } else {
            echo "Error updating employer password: " . $stmt2->error . "<br>";
        }
        $stmt2->close();
    }

    // Submit deletion request
    public function submitDeletionRequest($applicantID, $employerID)
    {
        // Determine which ID to use based on the provided parameters
        $ID = ($applicantID !== null) ? $applicantID : $employerID;
        $column = ($applicantID !== null) ? 'applicant_ID' : 'client_ID';

        // Prepare SQL statement to insert a new record into the Petition table
        $stmt = $this->conn->prepare("INSERT INTO petition (req_name, req_description, req_category, $column) VALUES (?, ?, ?, ?)");

        // Bind parameters
        $req_name = "Account Deletion";
        $req_description = "User wants to delete account";
        $req_category = "DELETE"; //change to RANK to check
        $stmt->bind_param("sssi", $req_name, $req_description, $req_category, $ID);

        // Execute the SQL statement
        if ($stmt->execute()) {
            return "Deletion request submitted successfully";
        } else {
            return "Error: " . $this->conn->error;
        }

        // Close the statement
        // $stmt->close();
    }

    // Check if the user has already submitted a deletion request
    // public function checkExistingDeletionRequest($userID, $userRole)
    // {
    //     // Determine which column to check based on the user's role
    //     $column = ($userRole === 'applicant') ? 'applicant_ID' : 'client_ID';

    //     // Prepare SQL statement to check for existing deletion request
    //     $stmt = $this->conn->prepare("SELECT COUNT(*) FROM petition WHERE $column = ? AND req_category = 'DELETE'"); //change to RANK to check
    //     $stmt->bind_param("i", $userID);

    //     // Execute the SQL statement
    //     $stmt->execute();
    //     $stmt->bind_result($count);
    //     $stmt->fetch();

    //     // Close the statement
    //     $stmt->close();

    //     // If count is greater than 0, an existing request is found
    //     return $count > 0;
    // }

    // // Inside the ProfileModel class
    // public function getApplicationsByUserID($userID, $userType) {
    //     // Determine the column to use based on user type
    //     $column = ($userType === 'Employer') ? 'job.client_ID' : 'applications_list.applicant_ID';

    //     // Prepare SQL statement to fetch job applications
    //     $stmt = $this->conn->prepare("
    //         SELECT job.jobName, 
    //                job.remuneration, 
    //                job.deadline, 
    //                employer.client_fname, 
    //                employer.client_lname, applications_list.application_status, applications_list.dateApplied
    //         FROM applications_list
    //         INNER JOIN job ON applications_list.job_ID = job.job_ID
    //         INNER JOIN employer ON job.client_ID = employer.client_ID
    //         WHERE $column = ?
    //     ");

    //     // Bind parameter
    //     $stmt->bind_param("i", $userID);

    //     // Execute the SQL statement
    //     $stmt->execute();

    //     // Get the result set
    //     $result = $stmt->get_result();

    //     // Close the statement
    //     $stmt->close();

    //     // Return the result set
    //     return $result;
    // }

    public function getApplicationsByUserID($userID, $userType)
    {
        // Determine the column to use based on user type
        $column = ($userType === 'Employer') ? 'job.client_ID' : 'applications_list.applicant_ID';

        // Prepare SQL statement to fetch job applications
        $stmt = $this->conn->prepare("
        SELECT job.job_ID,
               job.jobName, 
               job.job_rank, 
               job.remuneration, 
               job.deadline,
               job.job_status,
               job.dateAdded,
               employer.client_fname, 
               employer.client_lname, 
               applications_list.application_status, 
               applications_list.dateApplied
        FROM job
        LEFT JOIN applications_list ON job.job_ID = applications_list.job_ID
        INNER JOIN employer ON job.client_ID = employer.client_ID
        WHERE $column = ?
    ");

        // Bind parameter
        $stmt->bind_param("i", $userID);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Close the statement
        $stmt->close();

        // Return the result set
        return $result;
    }



    // for employee applicant list

    // Method to fetch applicants for a given job ID
    public function getApplicantsByJobId($job_ID)
    {
        // Prepare SQL statement to fetch applicants for the given job ID
        $sql = "
            SELECT applicant.user_fname, applicant.user_lname, applicant.user_contact, applicant.user_level
            FROM applications_list
            JOIN applicant ON applications_list.applicant_ID = applicant.applicant_ID
            WHERE applications_list.job_ID = ?
        ";

        // Prepare and bind parameters
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_ID);

        // Execute the statement
        $stmt->execute();

        // Get result set
        $result = $stmt->get_result();

        // Fetch results into an array
        $applicants = [];
        while ($row = $result->fetch_assoc()) {
            $applicants[] = $row;
        }

        // Close statement
        $stmt->close();

        // Return the array of applicants
        return $applicants;
    }

    public function getJobDetailsById($job_ID)
    {
        // Define the SQL query to retrieve job details by ID
        $query = "SELECT * FROM job WHERE job_ID = ?";

        // Prepare and execute the query
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $job_ID);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a row was returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $job_details = $result->fetch_assoc();
            return $job_details;
        } else {
            // No job details found for the provided job ID
            return null;
        }
    }


    // Method to update the application status
    public function updateApplicationStatus($applicationID, $newStatus)
    {
        // Prepare the SQL statement
        $sql = "UPDATE applications_list SET application_status = ? WHERE application_ID = ?";

        // Bind parameters and execute the query
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newStatus, $applicationID);

        // Execute the query
        if ($stmt->execute()) {
            // Query executed successfully
            return true;
        } else {
            // Query execution failed
            return false;
        }
    }


    public function getAccountTables()
    {

        $sql = "SELECT * FROM (
            SELECT 
                applicant_ID AS id,
                user_email AS email, 
                user_pwd AS password, 
                'Applicant' AS user_type, 
                user_fname AS first_name, 
                user_lname AS last_name,
                user_gender AS gender,
                user_age AS age,
                NULL AS org,
                NULL AS occ,
                user_addressLine AS addLine, 
                user_barangay AS brgy, 
                user_city AS city, 
                user_province AS province, 
                user_educ AS educ,
                user_mstat AS mstat,
                user_dob AS dob,
                user_CV AS docs 
            FROM applicant
            UNION 
            SELECT 
                client_ID AS id,
                client_email AS email, 
                client_pwd AS password, 
                'Employer' AS user_type, 
                client_fname AS first_name, 
                client_lname AS last_name,
                NULL AS gender,
                NULL AS age,
                client_organization AS org,
                client_occupation AS occ,
                client_addressLine AS addLine, 
                client_barangay AS brgy, 
                client_city AS city, 
                client_province AS province,
                NULL AS educ,
                NULL AS mstat,
                NULL AS dob,
                NULL AS docs
            FROM employer
        ) AS users";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function getAccountData($id, $accountType)
    {
        $userID = $id;
        $userRole = $accountType;

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $sql = "SELECT * FROM (
            SELECT 
                applicant_ID AS id,
                user_email AS email, 
                user_pwd AS password, 
                access AS user_type, 
                user_fname AS first_name, 
                user_lname AS last_name,
                user_gender AS gender,
                user_age AS age,
                NULL AS org,
                NULL AS occ,
                user_addressLine AS addLine, 
                user_barangay AS brgy, 
                user_city AS city, 
                user_province AS province, 
                user_educ AS educ,
                user_mstat AS mstat,
                user_dob AS dob,
                user_CV AS docs 
            FROM applicant
            UNION 
            SELECT 
                client_id AS id,
                client_email AS email, 
                client_pwd AS password, 
                access AS user_type, 
                client_fname AS first_name, 
                client_lname AS last_name,
                NULL AS gender,
                NULL AS age,
                client_organization AS org,
                client_occupation AS occ,
                client_addressLine AS addLine, 
                client_barangay AS brgy, 
                client_city AS city, 
                client_province AS province,
                NULL AS educ,
                NULL AS mstat,
                NULL AS dob,
                NULL AS docs
            FROM employer
        ) AS users WHERE id = ? AND user_type = ?";


        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ss", $userID, $userRole);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();


        echo "Number of rows: " . $result->num_rows;
        $accountData = array();

        // Check if a row is returned
        if ($result->num_rows == 1) {
            // // Fetch the row
            $row = $result->fetch_assoc();
            // $account_email = $row["email"];
            // $account_password = $row["password"];
            // $account_fName = $row["first_name"];
            // $account_lName = $row["last_name"];
            // $account_gender = $row["gender"];
            // $account_age = $row["age"];

            // //neutral variables?
            // $account_org = $row["org"];
            // $account_occ = $row["occ"];
            // $account_addLine = $row["addLine"];
            // $account_barangay = $row["brgy"];
            // $account_city = $row["city"];
            // $account_province = $row["province"];

            // $account_educ = $row["educ"];
            // $account_mstat = $row["mstat"];
            // $account_dob = $row["dob"];
            // $account_CV = $row["docs"];


            $accountData['email'] = $row["email"];
            $accountData['password'] = $row["password"];
            $accountData['first_name'] = $row["first_name"];
            $accountData['last_name'] = $row["last_name"];
            $accountData['gender'] = $row["gender"];
            $accountData['age'] = $row["age"];

            //neutral variables?
            $accountData['org'] = $row["org"];
            $accountData['occ'] = $row["occ"];
            $accountData['addLine'] = $row["addLine"];
            $accountData['brgy'] = $row["brgy"];
            $accountData['city'] = $row["city"];
            $accountData['province'] = $row["province"];

            $accountData['educ'] = $row["educ"];
            $accountData['mstat'] = $row["mstat"];
            $accountData['dob'] = $row["dob"];
            $accountData['docs'] = $row["docs"];

            //exit();
        } else {
            echo "Error Retrieving";
        }

        // Close the statement
        $stmt->close();
        return $accountData;
    }

    public function getPetitionTable()
    {
        $sql = "SELECT p.*,
            CASE 
                WHEN p.applicant_ID IS NOT NULL THEN a.user_fname
                ELSE e.client_fname
            END AS first_name,
            CASE 
                WHEN p.applicant_ID IS NOT NULL THEN a.user_lname
                ELSE e.client_lname
            END AS last_name
            -- req_ID, applicant_ID, client_ID, req_name, req_description, req_category, 
            FROM 
                petition p 
            LEFT JOIN 
                applicant a ON p.applicant_ID = a.applicant_ID
            LEFT JOIN 
                employer e ON p.client_ID = e.client_ID;";


        $result = $this->conn->query($sql);

        return $result;
    }

    public function deleteAccount($userID, $userRole, $reqID)
    {
        // Delete associated records in the petition table first
        $stmtPetition = $this->conn->prepare("DELETE FROM petition WHERE req_ID = ?");
        $stmtPetition->bind_param("i", $reqID);
        $deletePetitionSuccess = $stmtPetition->execute();
        $stmtPetition->close();

        // Determine which table to delete from based on the user's role
        if ($userRole == 'Applicant') {
            // Prepare SQL statement to delete the account and related records
            $stmt = $this->conn->prepare("DELETE FROM applicant WHERE applicant_ID = ?");
        } else if ($userRole == 'Client') {
            // Prepare SQL statement to delete the account and related records
            $stmt = $this->conn->prepare("DELETE FROM employer WHERE client_ID = ?");
        } else {
            // Handle other cases if necessary
            return false; // Indicate failure if the user role is not recognized
        }

        // Check if the statement preparation was successful
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }

        // Bind parameters
        $stmt->bind_param("i", $userID);

        // Execute the statement
        $deleteSuccess = $stmt->execute();

        // Check if execution was successful
        if (!$deleteSuccess) {
            echo "Error executing statement: " . $stmt->error;
            $stmt->close(); // Close the statement before returning
            return false;
        }

        // Close the statement
        $stmt->close();

        // If deletion from the main table was successful
        if ($deleteSuccess) {
            // Delete associated records in the job table
            $stmt2 = $this->conn->prepare("DELETE FROM job WHERE client_ID = ?");
            $stmt2->bind_param("i", $userID);
            $deleteJobSuccess = $stmt2->execute();
            $stmt2->close();

            // Check if associated deletions were successful
            if ($deleteJobSuccess && $deletePetitionSuccess) {
                return true;
            } else {
                echo "Error deleting associated records";
                return false;
            }
        } else {
            echo "Error deleting account";
            return false;
        }
    }
}
