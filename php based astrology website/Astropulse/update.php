<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Zodiac Signs</title>
    <link rel="stylesheet" href="update.css">
    <script>
        function validateForm() {
            var textareas = document.querySelectorAll('.update-textarea');
            for (var i = 0; i < textareas.length; i++) {
                if (textareas[i].value.trim() === '') {
                    alert('Please fill in all text areas.');
                    return false;
                }
            }
            return true;
        }

        function displaySuccessMessage() {
            alert('Zodiac signs updated successfully');
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Update Zodiac Signs</h1>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                // Loop through each zodiac sign and update the description
                $zodiacSigns = array(
                    "Aries",
                    "Taurus",
                    "Gemini",
                    "Cancer",
                    "Leo",
                    "Virgo",
                    "Libra",
                    "Scorpio",
                    "Sagittarius",
                    "Capricorn",
                    "Aquarius",
                    "Pisces"
                );

                // Prepare a statement for updating description
                $stmt = $conn->prepare("UPDATE zodiac_sign SET description=? WHERE sign=?");

                // Bind parameters
                $stmt->bind_param("ss", $description, $sign);

                foreach ($zodiacSigns as $sign) {
                    $description = $_POST[$sign];
                    $sign = $sign; // Assuming the column name in the database is 'sign'
                    $stmt->execute();
                    if ($stmt->errno) {
                        die("Error updating description for $sign: " . $stmt->error);
                    }
                }

                // Close the statement
                $stmt->close();

                // Close the connection
                $conn->close();

                // Display success message using JavaScript
                echo "<script>displaySuccessMessage();</script>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                <?php
                $zodiacSigns = array(
                    "Aries",
                    "Taurus",
                    "Gemini",
                    "Cancer",
                    "Leo",
                    "Virgo",
                    "Libra",
                    "Scorpio",
                    "Sagittarius",
                    "Capricorn",
                    "Aquarius",
                    "Pisces"
                );

                foreach ($zodiacSigns as $sign) {
                    echo "<div class='zodiac-sign'>";
                    echo "<h1>$sign</h1>";
                    echo "<textarea class='update-textarea' name='$sign'></textarea>";
                    echo "</div>";
                }
                ?>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

