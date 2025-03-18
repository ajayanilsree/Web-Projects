<?php
session_start(); // Start the session

// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root";
$password = "";
$dbname = "astrology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Retrieve and validate form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    // Validate username and password
    if (empty($username) || empty($password)) {
        echo "Username and password are required";
    } else {
        // Retrieve hashed password from the database
        $sql = "SELECT * FROM register WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Store username in session
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id']; // Store user ID for future use

                // Check if the user is an admin
                if ($username === "adminadmin" && $password === "Admin@1234") {
                    // Redirect to admin.html
                    header("Location: admin.html");
                    exit();
                } else {
                    // Redirect to user.html or any other page for regular users
                    header("Location: user1.php");
                    exit();
                }
            } else {
                // Invalid password
                echo "Invalid username or password";
            }
        } else {
            // Username not found
            echo "Invalid username or password";
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

