<?php
session_start();

if (isset($_POST["submit"])) {
    // Determine user role
    $user_role = isset($_SESSION['user_info']['user_type']) ? $_SESSION['user_info']['user_type'] : '';
    $user_ln = isset($_SESSION['user_info']['last_name']) ? $_SESSION['user_info']['last_name'] : '';

    // Define target directory based on user role
    if ($user_role == "Employer") {
        $target_dir = "Uploads/Employer/";
    } elseif ($user_role == "Applicant") {
        $target_dir = "Uploads/Applicant/";
    } else {
        // Default target directory if role is not defined or invalid
        $target_dir = "Uploads/";
    }
    
    // Get user ID
    $user_id = isset($_SESSION['user_info']['ID']) ? $_SESSION['user_info']['ID'] : '';

    // Extract file extension
    $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    // Define target file
    $target_file = $target_dir . $user_id . '_' . $user_ln . "_pp." . $imageFileType;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        // Delete existing file
        unlink($target_file);
    }
    
    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    $allowed_formats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
