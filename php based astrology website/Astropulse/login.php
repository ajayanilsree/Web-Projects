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

// Retrieve and validate form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    // Validate username and password
    if (empty($username) || empty($password)) {
        $errors[] = "Username and password are required";
    } else {
        // Retrieve hashed password from the database
        $sql = "SELECT * FROM register WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Login successful
                echo "Login successful";
                // You can redirect the user to a dashboard or another page here
            } else {
                // Invalid password
                $errors[] = "Invalid username or password";
            }
        } else {
            // Username not found
            $errors[] = "Invalid username or password";
        }
    }

    // Display validation errors
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

// Function to validate input data
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close the connection
$conn->close();
?>
