<?php
include '../../db_connection.php';

class DatabaseModel {
    private $conn;

    // Constructor that accepts the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function emailExistsInTable($email) {
        // Check in the applicant table
        $applicant_query = "SELECT * FROM applicant WHERE user_email = ?";
        $stmt_applicant = $this->conn->prepare($applicant_query);
        $stmt_applicant->bind_param("s", $email);
        $stmt_applicant->execute();
        $result_applicant = $stmt_applicant->get_result();
        $stmt_applicant->close();
    
        // Check in the employer table
        $employer_query = "SELECT * FROM employer WHERE client_email = ?";
        $stmt_employer = $this->conn->prepare($employer_query);
        $stmt_employer->bind_param("s", $email);
        $stmt_employer->execute();
        $result_employer = $stmt_employer->get_result();
        $stmt_employer->close();
    
        // Return true if email exists in either table
        return $result_applicant->num_rows > 0 || $result_employer->num_rows > 0;
    }
    
    public function insertapplicantInfo($firstname , $lastname,  $suffix,
                                       $email      , $contactNumber, 
                                       $password   , $access, 
                                       $gender     , $mstat,
                                       $dob        , $age,
                                       $addressLine, $barangay, 
                                       $city       , $province, 
                                       $educ       , $userLevel
                                       ) {
                                       $stmt = $this->conn->prepare("INSERT INTO applicant (user_fname     , user_lname, user_suffix,
                                                                                           user_email      , user_contact, 
                                                                                           user_pwd        , access,
                                                                                           user_gender     , user_mstat,
                                                                                           user_dob        , user_age,

                                                                                           user_addressLine, user_barangay, 
                                                                                           user_city       , user_province, 
                                                                                           user_educ       , user_level 
                                                                                           ) 
                                                                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                       $stmt->bind_param("ssssssssssissssss", $firstname , $lastname,  $suffix,
                                                                               $email      , $contactNumber, 
                                                                               $password   , $access, 
                                                                               $gender     , $mstat,
                                                                               $dob        , $age,
                                                                               $addressLine, $barangay, 
                                                                               $city       , $province, 
                                                                               $educ       , $userLevel,
                                                                               );
                                       $stmt->execute();
                                       $stmt->close();
                                   }

    public function insertEmployerInfo($firstname   , $lastname,  $suffix,
                                       $email       , $contactNumber, 
                                       $password    , $access, 
                                       $organization, $occupation, 
                                       $addressLine , $barangay, 
                                       $city        , $province,
                                       $employerType) {
                                       $stmt = $this->conn->prepare("INSERT INTO employer (client_fname       , client_lname,      client_suffix,
                                                                                           client_email       , client_contact, 
                                                                                           client_pwd         , access, 
                                                                                           client_organization, client_occupation, 
                                                                                           client_addressLine , client_barangay, 
                                                                                           client_city        , client_province,
                                                                                           account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                       $stmt->bind_param("ssssssssssssss", $firstname   , $lastname,   $suffix,
                                                                         $email       , $contactNumber, 
                                                                         $password    , $access, 
                                                                         $organization, $occupation, 
                                                                         $addressLine , $barangay, 
                                                                         $city        , $province,
                                                                         $employerType);
                                       $stmt->execute();
                                       $stmt->close();
                                   }

public function updateUserData($firstName, $lastName, $suffix, $email, $contact, $userID, $userType) {
    if ($userType === 'Applicant') {
        $this->updateApplicantData($firstName, $lastName, $suffix, $email, $contact, $userID);
    } elseif ($userType === 'Employer') {
        $this->updateEmployerData($firstName, $lastName, $suffix, $email, $contact, $userID);
    } else {
        // Handle unsupported user types or provide a default behavior
        echo "Unsupported user type: $userType";
    }
}

private function updateApplicantData($firstName, $lastName, $suffix, $email, $contact, $userID) {
    // Prepare SQL statement for updating applicant data
    $stmt = $this->conn->prepare("UPDATE applicant SET user_fname = ?, user_lname = ?, user_suffix = ?, user_email = ?, user_contact = ? WHERE applicant_ID = ?");
    $stmt->bind_param("sssssi", $firstName, $lastName, $suffix, $email, $contact, $userID);
}

private function updateEmployerData($firstName, $lastName, $suffix, $email, $contact, $userID) {
    // Prepare SQL statement for updating employer data
    $stmt = $this->conn->prepare("UPDATE employer SET client_fname = ?, client_lname = ?, client_suffix = ?, client_email = ?, client_contact = ? WHERE client_ID = ?");
    $stmt->bind_param("sssssi", $firstName, $lastName, $suffix, $email, $contact, $userID);
    $stmt->execute();
    $stmt->close();
}
                                
                                
}
?>
