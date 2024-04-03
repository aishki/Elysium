<?php
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

// Fetch data from applicant table
$query_applicant = "SELECT applicant_ID, user_fname AS first_name, user_lname AS last_name FROM applicant";
$result_applicant = mysqli_query($conn, $query_applicant);

// Check if the query was successful
if (!$result_applicant) {
    die("Query failed: " . mysqli_error($conn));
}

// Output the list for applicants
while ($row_applicant = mysqli_fetch_assoc($result_applicant)) {
    $id = $row_applicant['applicant_ID'];

    echo    '<a class="accountLink" href="indexModify.php?id=' . $id . '">';
    echo    '<div class="account_instance" style="text-decoration:none;">';
    echo    '    <span class="name">' . htmlspecialchars($row_applicant["first_name"]) . '</span>';
    echo    '    <span class="name">' . htmlspecialchars($row_applicant["last_name"]) . '</span>';
    echo    '</div>';
    echo    '</a>';
}

// Fetch data from employer table
$query_employer = "SELECT client_ID, client_fname AS first_name, client_lname AS last_name FROM employer";
$result_employer = mysqli_query($conn, $query_employer);

// Check if the query was successful
if (!$result_employer) {
    die("Query failed: " . mysqli_error($conn));
}

// Output the list for employers
while ($row_employer = mysqli_fetch_assoc($result_employer)) {
    $id = $row_employer['client_ID'];

    echo    '<a class="accountLink" href="indexModify.php?id=' . $id . '">';
    echo    '<div class="account_instance" style="text-decoration:none;">';
    echo    '    <span class="name">' . htmlspecialchars($row_employer["first_name"]) . '</span>';
    echo    '    <span class="name">' . htmlspecialchars($row_employer["last_name"]) . '</span>';
    echo    '</div>';
    echo    '</a>';
}

// Close connection
mysqli_close($conn);
?>