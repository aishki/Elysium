<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$db         = "booking_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["newUsername"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $newUsername = mysqli_real_escape_string($conn, $_POST["newUsername"]);

    // Update the username in the database
    $query = "UPDATE login_system_data SET username = '$newUsername' WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Username updated successfully";
    } else {
        echo "Error updating username: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>