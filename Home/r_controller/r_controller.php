<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../r_model/r_model.php';

class RegistrationController {
    public function registerUser() {
        // Validate form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Check if all required fields are present
            if (isset($_POST['fname'], 
                      $_POST['lname'],
                      $_POST['suffix'], 
                      $_POST['email'], 
                      $_POST['contactNumber'], 
                      $_POST['pwd'], 
                      $_POST['access'])) {
                        // note: POST uses name


                // Get form data
                $firstname      = ucwords($_POST['fname']); 
                $lastname       = ucwords($_POST['lname']); 
                $suffix         = ucwords($_POST['suffix']);
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
                            $this->insertapplicantInfo($databaseModel, $firstname, $lastname, $suffix, $email, $contactNumber, $password, $access);
                            break;
                        case 'Employer':
                            $this->insertEmployerInfo($databaseModel, $firstname, $lastname, $suffix, $email, $contactNumber, $password, $access);
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
        
        // After setting $email_exists, use it to display the error message and redirect back to the registration page with the error indication
        if ($email_exists) {
            // Redirect back to the registration page with an indication of the email error
            header("Location: ../regis/register.php?email_exists=true");
            exit();
        }
    }



    private function isEmailUnique($databaseModel, $email) {
        // Check if email exists in applicant or employer table
        $applicantExists = $databaseModel->emailExistsInTable($email);
        return !$applicantExists;
    }


    private function insertEmployerInfo($databaseModel, $firstname, $lastname, $suffix, $email, $contactNumber, $password, $access) {
        $employerType = $_POST['emp_type'];

        // Check if the user selected "Company" or "Personal"
            if ($employerType === "Company") {

            // Extract employer info for Company
            $organization = $_POST['ct_company'];
            $occupation   = $_POST['ct_occupation'];
            $addressLine  = $_POST['ct_client_addLine'];
            $barangay     = $_POST['ct_client_brgy'];
            $city         = $_POST['ct_client_city'];
            $province     = $_POST['ct_client_province'];
            
            // Insert company details
              $databaseModel->insertEmployerInfo($firstname, $lastname, $suffix, $email, $contactNumber, $password, $access, $organization, $occupation, $addressLine, $barangay, $city, $province, $employerType);
            } else {

            // Extract employer info for Personal
            $organization = $_POST['pd_company'];
            $occupation   = $_POST['pd_occupation'];
            $addressLine  = $_POST['pd_client_addLine'];
            $barangay     = $_POST['pd_client_brgy'];
            $city         = $_POST['pd_client_city'];
            $province     = $_POST['pd_client_province'];
            
            // Insert personal details
                $databaseModel->insertEmployerInfo($firstname, $lastname, $suffix, $email, $contactNumber, $password, $access, $organization, $occupation, $addressLine, $barangay, $city, $province, $employerType);
            }
    }

    private function insertapplicantInfo($databaseModel, $firstname, $lastname, $suffix, $email, $contactNumber, $password, $access) {
        // Extract applicant info from $_POST
        $gender      = $_POST['gender'];
        $mstat       = $_POST['marital_stat'];
        $dob         = $_POST['DOB'];
        $age         = $_POST['age'];

        $addressLine = $_POST['addLine'];
        $barangay    = $_POST['brgy'];
        $city        = $_POST['city'];
        $province    = $_POST['province'];
        $educ        = $_POST['edu_attainment'];
        // $license     = $_POST['license'];

        $userLevel   = 'D'; // Rank 'D' for Default
        
        // Insert applicant info
        $databaseModel->insertapplicantInfo($firstname, $lastname, $suffix, $email, $contactNumber, $password, $access, $gender, $mstat, $dob, $age, $addressLine, $barangay, $city, $province, $educ, $userLevel);
    }
}

// Instantiate RegistrationController and call registerUser method
$registrationController = new RegistrationController();
$registrationController->registerUser();
?>