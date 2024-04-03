<?php
    $id = $_GET["id"];
    $accountType = $_GET["accountType"];
    
    
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
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $accountType);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    echo "Number of rows: " . $result->num_rows;
    
    // Check if a row is returned
    if ($result->num_rows == 1) {
        // Fetch the row
        $row = $result->fetch_assoc();
        $account_email = $row["email"];
        $account_password = $row["password"];
        $account_fName = $row["first_name"];
        $account_lName = $row["last_name"];
        $account_gender = $row["gender"];
        $account_age = $row["age"];
    
        //neutral variables?
        $account_org = $row["org"];
        $account_occ = $row["occ"];
        $account_addLine = $row["addLine"];
        $account_barangay = $row["brgy"];
        $account_city = $row["city"];
        $account_province = $row["province"];
    
        $account_educ = $row["educ"];
        $account_mstat = $row["mstat"];
        $account_dob = $row["dob"];
        $account_CV = $row["docs"];
    
        //exit();
    }
    
    // Close database connection
    $conn->close();
    

?>