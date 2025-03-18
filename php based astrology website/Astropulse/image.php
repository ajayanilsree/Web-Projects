<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astrology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$description = $_POST['description'];
$image_data = file_get_contents($_FILES['image']['tmp_name']);

// Prepare INSERT statement
$stmt = $conn->prepare("INSERT INTO zodiac_sign (sign, description, image) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $description, $image_data);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo "Record inserted successfully for sign: $name";
} else {
    echo "Error inserting record for sign: $name";
}

// Close connection
$conn->close();
?>

