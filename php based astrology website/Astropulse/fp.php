<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root";
$password = "";
$dbname = "astrology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variable
$errors = array();

// Retrieve form data
$username = $_POST['username'];
$dob = $_POST['dob'];
$new_password = $_POST['new_password'];

// Sanitize and validate the form data (you should enhance this part according to your requirements)
$username = mysqli_real_escape_string($conn, $username);
$dob = mysqli_real_escape_string($conn, $dob);
$new_password = mysqli_real_escape_string($conn, $new_password);

// Validate password
if (empty($new_password)) {
    $errors[] = "New password is required";
} elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $new_password)) {
    $errors[] = "New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character";
}

// Check if the username and DOB match the records in the register table
$sql = "SELECT * FROM register WHERE username='$username' AND dob='$dob'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Username and DOB match
    if (empty($errors)) {
        // Update the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE register SET password='$hashed_password' WHERE username='$username'";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Password reset successful";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        // Display password validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    // Username and DOB do not match
    echo "Invalid username or date of birth. Please try again.";
}

// Close the connection
$conn->close();
?>
