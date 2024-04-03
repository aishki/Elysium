<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../classes/class-info.php';

class RegistrationController {
    public function registerUser() {
        // Validate form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Check if all required fields are present
            if (isset($_POST['fname'], 
                      $_POST['lname'], 
                      $_POST['email'], 
                      $_POST['pwd'], 
                      $_POST['contactNumber'], 
                      $_POST['access'])) {

                // Get form data
                $firstname      = ucwords($_POST['fname']); 
                $lastname       = ucwords($_POST['lname']); 
                $email          = $_POST['email'];
                $contactNumber  = $_POST['contactNumber'];
                $password       = $_POST['pwd'];
                $access         = $_POST['access'];

                include '../../db_connection.php'; 
                // Create DatabaseModel instance
                $databaseModel = new DatabaseModel($conn);

                // Check if email is unique | no duplicates allowed
                if ($this->isEmailUnique($databaseModel, $email)) {
                    // Depending on the access type, insert user info
                    switch ($access) {
                        case 'Applicant':
                            $this->insertapplicantInfo($databaseModel, $firstname, $lastname, $email, $contactNumber, $password, $access);
                            break;
                        case 'Employer':
                            $this->insertEmployerInfo($databaseModel, $firstname, $lastname, $email, $contactNumber, $password, $access);
                            break;
                        default:
                            throw new Exception("Invalid access type." );
                    }
                    
                    // Set session email after successful registration
                    session_start();
                    $_SESSION['email'] = $email;

                    // Redirect to login page after successful registration
                    header('Location: ../log-in/log-in.php');
                    exit();
                } else {
                    // Set $email_exists to true because the email already exists
                    $email_exists = true;
                }
                
            } else {
                // Required fields are missing
                throw new Exception("Required fields are missing.");
            }
        } else {
            // Handle invalid request method
            throw new Exception("Invalid request method.");
        }
        
        // After setting $email_exists, use it to display the error message and disable the submit button
        if ($email_exists) {
            // Display error message and disable submit button
            echo '<div id="emailError" style="display: block;">Email already exists.</div>';
            echo '<script>document.getElementById("submitButton").disabled = true;</script>';
        }
    }


    private function isEmailUnique($databaseModel, $email) {
        // Check if email exists in applicant or employer table
        $applicantExists = $databaseModel->emailExistsInTable($email);
        return !$applicantExists;
    }

    private function insertEmployerInfo($databaseModel, $firstname, $lastname, $email, $contactNumber, $password, $access) {
        // Extract employer info
        $organization = $_POST['company'];
        $occupation   = $_POST['occupation'];
        $addressLine  = $_POST['client_addLine'];
        $barangay     = $_POST['client_brgy'];
        $city         = $_POST['client_city'];
        $province     = $_POST['client_province'];

        // Insert employer info
        $databaseModel->insertEmployerInfo($firstname, $lastname, $email, $contactNumber, $password, $access, $organization, $occupation, $addressLine, $barangay, $city, $province);
    }

    private function insertapplicantInfo($databaseModel, $firstname, $lastname, $email, $contactNumber, $password, $access) {
        // Extract applicant info from $_POST
        $addressLine = $_POST['addLine'];
        $barangay    = $_POST['brgy'];
        $city        = $_POST['city'];
        $province    = $_POST['province'];
        $educ        = $_POST['educ'];
        $gender      = $_POST['gender'];
        $mstat       = $_POST['marital_stat'];
        $dob         = $_POST['DOB'];
        $age         = $_POST['age'];
        $license     = $_POST['license'];

        $userLevel   = 'D'; // Rank 'D' for Default
        
        // Insert applicant info
        $databaseModel->insertapplicantInfo($firstname, $lastname, $email, $contactNumber, $password, $access, $addressLine, $barangay, $city, $province, $educ, $gender, $mstat, $dob, $age, $license, $userLevel);
    }
}

// Instantiate RegistrationController and call registerUser method
$registrationController = new RegistrationController();
$registrationController->registerUser();
?>