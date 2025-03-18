<?php
// Database connection
$servername = "localhost";
$username = "username"; // Replace with your database username
$password = "password"; // Replace with your database password
$dbname = "astrology"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['text'];

// Insert data into database
$sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "Thank you! Your message has been sent.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
