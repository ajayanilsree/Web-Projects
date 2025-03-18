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
    $confirmPassword = validate_input($_POST['confirmPassword']);
    $dob = validate_input($_POST['dob']);
    $zodiacSign = validate_input($_POST['zodiacSign']);

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9]{5,}$/", $username)) {
        $errors[] = "Username must contain at least 5 characters and consist of letters, numbers";
    } else {
        // Check if username already exists in the database
        $check_username_sql = "SELECT * FROM register WHERE username='$username'";
        $result = $conn->query($check_username_sql);
        if ($result->num_rows > 0) {
            $errors[] = "Username already exists. Please choose another username";
        }
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $errors[] = "Confirm password is required";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // Validate date of birth
    if (empty($dob)) {
        $errors[] = "Date of birth is required";
    }

    // Validate zodiac sign
    if (empty($zodiacSign)) {
        $errors[] = "Zodiac sign is required";
    }

    // If no validation errors, proceed with registration
    if (empty($errors)) {
        // Sanitize data
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $dob = mysqli_real_escape_string($conn, $dob);
        $zodiacSign = mysqli_real_escape_string($conn, $zodiacSign);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the register table
        $sql = "INSERT INTO register (username, password, dob, zodiac_sign) VALUES ('$username', '$hashed_password', '$dob', '$zodiacSign')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
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

