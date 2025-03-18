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

// Assuming you have already authenticated the user and have their username stored in a variable
$user_username = "user1"; // Replace this with the actual username of the logged-in user

// Query to retrieve the user's name from the database based on their username
$sql = "SELECT username FROM register WHERE username = '$user_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $user_name = $row["name"];
    }
} else {
    $user_name = "User"; // Default to "User" if username is not found in the database
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Home</title>
<link rel="stylesheet" href="user.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">User Panel</h1>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <h2>Hello, <?php echo $user_name; ?></h2>
            <div class="blocks">
                <div class="block" onclick="location.href='horoscope.php';">
                    <h3>Daily Horoscope</h3>
                    <p>view your daily horoscope</p>
                </div>
                <div class="block" onclick="location.href='contact.html';">
                    <h3>Contact Admin</h3>
                    <p>contact admin for any doubt</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 User Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
