<?php
// Start session
session_start();

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

// Retrieve user's horoscope sign information from the database based on their preferences
$username = $_SESSION['username'];
$sql = "SELECT * FROM register WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $horoscopeSign = $row['zodiac_sign']; // Assuming you have a column 'horoscope_sign' in your users table
} else {
    $horoscopeSign = "Aries"; // Default sign if user's sign is not found
}

// Construct image path based on the user's horoscope sign
$imagePath = "images/" . strtolower($horoscopeSign) . ".jpg"; // Assuming your images are stored as 'aries.jpg', 'taurus.jpg', etc.

// Check if the image file exists, if not, use a default image
if (file_exists($imagePath)) {
    $signImage = $imagePath;
} else {
    $signImage = "images/default_image.jpg"; // Default image if the specific sign image is not found
}

// Retrieve horoscope sign description from the database
$sql = "SELECT * FROM zodiac_sign WHERE sign='$horoscopeSign'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $signDescription = $row['description'];
} else {
    $signDescription = "No description available"; // Default description if sign information is not found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horoscope</title>
    <link rel="stylesheet" href="horoscope.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo"> Daily Horoscope</h1>
            <a href="login.html" class="logout-btn">Logout</a>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <h2>Your Horoscope Sign: <?php echo $horoscopeSign; ?></h2>
            <div class="horoscope-info">
                <img src="<?php echo $signImage; ?>" alt="Horoscope Sign" class="sign-image">
                <p class="sign-description"><?php echo $signDescription; ?></p>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Horoscope. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

