<?php
include '../Home/config/config.php';

$servername = "localhost";
$username   = "root";
$password   = "";
$db         = "elysium";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET["id"];

// Fetch data from applicant table
$query_applicant = "SELECT applicant_ID, user_fname AS first_name, user_lname AS last_name FROM applicant WHERE applicant_ID = '$id'";
$result_applicant = mysqli_query($conn, $query_applicant);

// Fetch data from employer table
$query_employer = "SELECT client_ID, client_fname AS first_name, client_lname AS last_name FROM employer WHERE client_ID = '$id'";
$result_employer = mysqli_query($conn, $query_employer);

// Check if data is found in either applicant or employer table
if (mysqli_num_rows($result_applicant) > 0) {
    $row = mysqli_fetch_assoc($result_applicant); // Fetch data from applicant table
    $table_name = 'applicant';
} elseif (mysqli_num_rows($result_employer) > 0) {
    $row = mysqli_fetch_assoc($result_employer); // Fetch data from employer table
    $table_name = 'employer';
} else {
    // Handle case where no data found for the id
    echo "Error: User not found";
    exit();
}

// Assign retrieved data to variables
$fname = $row['first_name'];
$lname = $row['last_name'];

// Update and Delete Account
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newEmail"]) && isset($_POST["pwd"])) {
        $newEmail = mysqli_real_escape_string($conn, $_POST["newEmail"]);
        $newPassword = $_POST["pwd"];  // Not escaping for demonstration, but consider security implications

        // Update both email and password in the database
        $query_update = "UPDATE $table_name SET user_fname = '$newEmail', user_lname = '$newPassword' WHERE $table_name_ID = '$id'";
        $result_update = mysqli_query($conn, $query_update);

        if ($result_update) {
            echo "Email and password updated successfully";
        } else {
            echo "Error updating email and password: " . mysqli_error($conn);
        }
    } elseif (isset($_POST["delete"])) {
        // Delete the account from the database
        $query_delete = "DELETE FROM $table_name WHERE $table_name_ID = '$id'";
        $result_delete = mysqli_query($conn, $query_delete);

        if ($result_delete) {
            // Redirect to the accounts list page
            header("Location: ../Admin/accountList.php");
        } else {
            echo "Error deleting account: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../Assets/css/navbar.css">
    <link rel="stylesheet" href="../Assets/css/gen_info.css">
    <link rel="stylesheet" href="../Assets/css/accountList.css">

</head>

<body>
    <?php
    include '../navbar/navbar.php';
    ?>

    <div class="container">
        <a class="greyed" href="accountList.php">
            <h2>Accounts List</h2>
        </a>
        <h2> > <?php echo $fname . ' ' . $lname ?></h2>

        <form method="POST" action="">
            <div class="container">
                <h2>Update</h2>
                <div class="input-group">
                    <br>
                    <br>

                    <strong><label for="email">Current Email</label></strong>
                    <span style="font-style: italic;"><?php echo $email ?></span>
                </div>
                <br>
                <div class="input-group">
                    <strong><label for="email">New Email</label></strong>
                    <input type="email" name="newEmail" id="email" placeholder="sample@gmail.com">
                </div>

                <br>
                <div class="input-group">
                    <strong><label for="pwd">Current Password</label></strong>
                    <span style="font-style: italic;"><?php echo $password ?></span>
                </div>
                <br>
                <div class="input-group">
                    <strong><label for="pwd">New Password</label></strong>
                    <input type="password" name="pwd" id="password" placeholder="Password">
                </div>

                <br><br>
                <div class="button-container">
                    <input type="submit" value="Update">
                </div>
            </div>
        </form>

        <div class="container">
            <h2>Delete</h2>
            <div class="button-container delete">
                <button type="button" onclick="confirmDelete()">Delete Account</button>
            </div>
        </div>



        <?php



        // Close the connection
        mysqli_close($conn);


        ?>
    </div>

    <script>
        function confirmDelete() {
        // Ask for confirmation
        let confirmed = confirm("Are you sure you want to delete this account?");

        if (confirmed) {
            // Submit the form with a hidden field indicating deletion
            let form = document.querySelector("form");
            let hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "delete";
            hiddenInput.value = "true";
            form.appendChild(hiddenInput);
            form.submit(); // Submit the form to the PHP script
        }
        }
    </script>